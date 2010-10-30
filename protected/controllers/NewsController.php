<?php

class NewsController extends Controller
{
	public $layout = '//layouts/section';
	
	private $_newsArticle;
	
	public function filters()
	{
		return array(
			'rights + create, edit, delete',
			array(
				'SpaceFixer',
			),
		);
	}
	
	public function actionItem($id)
	{
		$model = $this->loadModel($id);
		
		$links = array();
		$webUser = Yii::app()->user;
		if (!$webUser->isGuest && $webUser->checkAccess('News.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'id' => $model->id,
			));
		}
		if (!$webUser->isGuest && $webUser->checkAccess('News.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'id' => $model->id,
			));
		}
		
		$this->layout = '//layouts/article';
		$this->render('item', array(
			'model' => $model,
			'links' => $links,
		    'shortTitle' => TextHelper::truncate($model->title, 70, '…', true),
		));
	}
	
	public function actionList()
	{
		$dataProvider = new CActiveDataProvider('News', array(
			'pagination' => array(
				'pageSize' => 10,
			),
		));

		$webUser = Yii::app()->user;
		$links = array();
		if (!$webUser->isGuest && $webUser->checkAccess('News.Create'))
		{
			$links['create'] = $this->createUrl('create');
		}
		
		$data = $dataProvider->getData();
		$links['article'] = array();
		foreach ($data as $item)
		{
			$itemLinks = array();
			if (!$webUser->isGuest && $webUser->checkAccess('News.Edit'))
			{
				$itemLinks['edit'] = $this->createUrl('edit', array(
					'id' => $item->id,
				));
			}
			if (!$webUser->isGuest && $webUser->checkAccess('News.Delete'))
			{
				$itemLinks['delete'] = $this->createUrl('delete', array(
					'id' => $item->id,
				));
			}
			$links['article'][] = $itemLinks;
		}
		
		$viewParameters = array(
			'dataProvider' => $dataProvider,
			'links' => $links,
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

		$this->layoutClass = 'wide';
		$this->layout = '//layouts/section-wide';
		$this->render('create', array(
			'model' => $model,
		));
	}
	
	public function actionEdit($id)
	{
		$model = $this->loadModel($id);
		
		if (isset($_POST['News']))
		{
			$model->attributes = $_POST['News'];
			if ($model->save())
			{
				Yii::app()->cache->delete('model-news-' . $id);
				Yii::app()->cache->delete('model-news-latest-10');
				$this->redirect(array('item', 'id' => $model->id));
			}
		}

		$this->layoutClass = 'wide';
		$this->layout = '//layouts/section-wide';
		$this->render('edit', array(
			'model' => $model,
		));
	}
	
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->delete();
				Yii::app()->cache->delete('model-news-' . $id);
				Yii::app()->cache->delete('model-news-latest-10');
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
	
	public function loadModel($id)
	{
		$newsArticleId = (int)$id;
		$cacheId = "model-news-$newsArticleId";
		if (($this->_newsArticle = Yii::app()->cache->get($cacheId)) === false)
		{
			$this->_newsArticle = News::model()->findByPk($newsArticleId);
			if ($this->_newsArticle === null)
			{
				Yii::log("News item with id=$newsArticleId is not found", 'error',
					'application.controllers.NewsController');
				throw new CHttpException(404, 'Новость не найдена.');
			}
			Yii::app()->cache->set($cacheId, $this->_newsArticle, 3600);
		}
		return $this->_newsArticle;
	}
	
	public function actionFeed()
	{
		Yii::import('application.vendors.*');
		require_once('Zend/Loader/Autoloader.php');
		Yii::registerAutoloader(array('Zend_Loader_Autoloader', 'autoload'));
		
		if (($latestNews = Yii::app()->cache->get('model-news-latest-10')) === false)
		{
			$latestNews = News::model()->findAll(array(
				'limit' => 10,
			));
			Yii::app()->cache->set('model-news-latest-10', $latestNews, 3600);
		}
		
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
