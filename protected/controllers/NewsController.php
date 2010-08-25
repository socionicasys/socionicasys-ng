<?php

class NewsController extends Controller
{
	public $layout = '//layouts/section';
	
	private $_newsArticle;
	
	public function filters()
	{
		return array(
			'accessControl + create, edit, delete',
		);
	}
	
	public function accessRules()
	{
		// TODO: заменить на полноценную проверку прав.
		return array(
			array('allow',
				'actions' => array('create', 'edit', 'delete'),
				'users' => array('@'),
			),
			array('deny'),
		);
	}
	
	public function actionItem()
	{
		$model = $this->loadModel();
		
		$articleLinks = array();
		// TODO: заменить на полноценную проверку прав.
		if (!Yii::app()->user->isGuest)
		{
			$articleLinks['edit'] = array();
			$articleLinks['edit']['route'] = 'edit';
			$articleLinks['edit']['params'] = array('id' => $model->id);
			$articleLinks['delete'] = array();
			$articleLinks['delete']['route'] = 'delete';
			$articleLinks['delete']['params'] = array('id' => $model->id);
		}
		
		$this->layout = '//layouts/article';
		$this->render('item', array(
			'model' => $model,
			'articleLinks' => $articleLinks,
		));
	}
	
	public function actionList()
	{
		$dataProvider = new CActiveDataProvider('News', array(
			'pagination' => array(
				'pageSize' => 10,
			),
		));
		
		// TODO: заменить на полноценную проверку прав.
		$userAuthenicated = !Yii::app()->user->isGuest;
		
		if ($userAuthenicated)
		{
			$createUrlRoute = 'create';
			$createUrlParams = array();
		}
		else
		{
			$createUrlRoute = null;
			$createUrlParams = null;
		}
		
		$data = $dataProvider->getData();
		$articleLinks = array();
		foreach ($data as $item)
		{
			$itemLinks = array();
			if ($userAuthenicated)
			{
				$itemLinks['edit'] = array();
				$itemLinks['edit']['route'] = 'edit';
				$itemLinks['edit']['params'] = array('id' => $item->id);
				$itemLinks['delete'] = array();
				$itemLinks['delete']['route'] = 'delete';
				$itemLinks['delete']['params'] = array('id' => $item->id);
			}
			$articleLinks[] = $itemLinks;
		}
		
		$viewParameters = array(
			'dataProvider' => $dataProvider,
			'createUrlRoute' => $createUrlRoute,
			'createUrlParams' => $createUrlParams,
			'articleLinks' => $articleLinks,
		);
		
		if (Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial('list', $viewParameters);
		}
		else
		{
			$this->render('list', $viewParameters);
		}
	}
	
	public function actionCreate()
	{
		$model = new News;
		
		if (isset($_POST['News']))
		{
			$model->attributes = $_POST['News'];
			if ($model->save())
			{
				$this->redirect(array('item', 'id' => $model->id));
			}
		}
		
		$this->render('create', array(
			'model' => $model,
		));
	}
	
	public function actionEdit()
	{
		$model = $this->loadModel();
		
		if (isset($_POST['News']))
		{
			$model->attributes = $_POST['News'];
			if ($model->save())
			{
				$this->redirect(array('item', 'id' => $model->id));
			}
		}
		
		$this->render('edit', array(
			'model' => $model,
		));
	}
	
	public function actionDelete()
	{
		$model = $this->loadModel();
		
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->delete();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
			}
			else
			{
				$this->redirect(array('item', 'id' => $model->id));
			}
		}
		
		$this->render('delete', array(
			'model' => $model,
		));
	}
	
	public function loadModel()
	{
		if (!isset($_GET['id']))
		{
			Yii::log('News item id not set', 'error',
				'application.controllers.NewsController');
			throw new CHttpException(404, 'Новость не найдена.');
		}
		
		$newsArticleId = intval($_GET['id']);
		$this->_newsArticle = News::model()->findByPk($newsArticleId);
		if ($this->_newsArticle === null)
		{
			Yii::log("News item with id=$newsArticleId is not found", 'error',
				'application.controllers.NewsController');
			throw new CHttpException(404, 'Новость не найдена.');
		}
		return $this->_newsArticle;
	}
	
	public function actionFeed()
	{
		Yii::import('application.vendors.*');
		require_once('Zend/Loader/Autoloader.php');
		Yii::registerAutoloader(array('Zend_Loader_Autoloader', 'autoload'));
		
		$latestNews = News::model()->findAll(array(
			'limit' => 10,
		));
		
		$feedEntries = array();
		$lastUpdateTime = null; 
		foreach ($latestNews as $newsItem)
		{
			$entryUrl = $this->createAbsoluteUrl('item', array(
				'id' => $newsItem->id
			)); 
			if ($lastUpdateTime === null)
			{
				$lastUpdateTime = $newsItem->post_time;
			}
			// Поле 'description' не может содержать HTML-код. Преобразуем
			// HTML-описание в текст с помощью strip_tags().
			$description = strip_tags($newsItem->text);
			$feedEntries[] = array(
				'title' => $newsItem->title,
				'link' => $entryUrl,
				'guid' => $entryUrl,
				'description' => $description,
				'content' => $newsItem->text,
				'lastUpdate' => $newsItem->post_time,
			);
		}
		
		$feed = Zend_Feed::importArray(array(
			'title' => 'Новости сайта Школы системной соционики',
			'author' => 'Школа системной соционики',
			'link' => CHtml::encode($this->createAbsoluteUrl('')),
			'charset' => 'UTF-8',
			'lastUpdate' => $lastUpdateTime,
			'entries' => $feedEntries,
		), 'atom');
		$feed->send();
	}
}
