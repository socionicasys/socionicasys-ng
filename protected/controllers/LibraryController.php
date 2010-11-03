<?php

class LibraryController extends Controller
{
	public $layout = '//layouts/section-wide';

	private $_model;
	
	public function filters()
	{
		return array(
			'rights + create, edit, delete',
			array(
				'SpaceFixer',
			),
		);
	}
	
	public function actionView($type, $title)
	{
		$model = $this->loadModel($type, $title);

		if ($model->meta_description !== null)
		{
			$this->pageDescription = $model->meta_description;
		}
		if ($model->meta_keywords !== null)
		{
			$this->pageKeywords = $model->meta_keywords;
		}

		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->baseUrl . '/scripts/hyphenate.js'
		);
		$this->layout = '//layouts/article-wide';
		$this->render("$type-item", array(
			'model' => $model,
		    'shortTitle' => TextHelper::truncate($model->title, 70, '…', true),
		));
	}
	
	public function renderItemLinks($type, $title)
	{
		$links = array();
		$webUser = Yii::app()->user;
		if (!$webUser->isGuest && $webUser->checkAccess('Library.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'type' => $type,
				'title' => $title,
			));
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Library.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'type' => $type,
				'title' => $title,
			));
		}
		
		$this->renderPartial('item-links', array(
			'links' => $links,
		));
	}
	
	public function actionList($type)
	{
		switch ($type)
		{
		case 'statji':
			$modelClass = 'Article';
			$defaultOrder = 'published_number DESC';
			break;
		default:
			Yii::log("Unknow category $type in library list",
				'error', 'application.controllers.LibraryController');
			throw new CHttpException(404, 'Страница не найдена.');
		}
		$dataProvider = new CActiveDataProvider($modelClass, array(
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => $defaultOrder,
			),
		));

		$viewParameters = array(
			'dataProvider' => $dataProvider,
			'type' => $type,
		);

		$this->layoutClass = 'wide';
		if (Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial("$type-list", $viewParameters);
		}
		else
		{
			$this->render("$type-list", $viewParameters);
		}
	}
	
	public function renderListLinks($type)
	{
		$webUser = Yii::app()->user;
		$links = array();
		if (!$webUser->isGuest && $webUser->checkAccess('Library.Create'))
		{
			$links['create'] = $this->createUrl('create', array(
				'type' => $type
			));
		}
		
		$this->renderPartial('list-links', array(
			'links' => $links,
		));
	}
	
	public function actionCreate($type)
	{
		switch ($type)
		{
		case 'statji':
			$modelClass = 'Article';
			break;
		default:
			Yii::log("Unknow category $type",
				'error', 'application.controllers.LibraryController');
			throw new CHttpException(404, 'Страница не найдена.');
		}
		$model = new $modelClass;
		
		if (isset($_POST[$modelClass]))
		{
			$model->attributes = $_POST[$modelClass];
			if ($model->save())
			{
				$this->redirect(array(
					'view',
					'type' => $type,
					'title' => $model->url,
				));
			}
		}

		$this->layoutClass = 'wide';
		$this->render("$type-create", array(
			'model' => $model,
		));
	}
	
	public function actionEdit($type, $title)
	{
		$model = $this->loadModel($type, $title);
		$modelClass = get_class($model);
		
		if (isset($_POST[$modelClass]))
		{
			$model->attributes = $_POST[$modelClass];
			if ($model->save())
			{
				Yii::app()->cache->delete("model-library-$type-$title");
				$this->redirect(array(
					'view',
					'type' => $type,
					'title' => $model->url,
				));
			}
		}

		$this->layoutClass = 'wide';
		$this->render("$type-edit", array(
			'model' => $model,
		));
	}
	
	public function actionDelete($type, $title)
	{
		$model = $this->loadModel($type, $title);
		
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->delete();
				Yii::app()->cache->delete("model-library-$type-$title");
				$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] :
					array('list', 'type' => $type)
				);
			}
			else
			{
				$this->redirect(array(
					'view',
					'type' => $type,
					'title' => $model->url,
				));
			}
		}

		$this->layoutClass = 'wide';
		$this->render("$type-delete", array(
			'model' => $model,
		));
	}
	
	/**
	 * @param string $type
	 * @param string $title
	 * @return Library
	 * @throws CHttpException
	 */
	public function loadModel($type, $title)
	{
		$cacheId = "model-library-$type-$title";
		if (($this->_model = Yii::app()->cache->get($cacheId)) === false)
		{
			$this->_model = Library::model()->findByAttributes(array(
				'type' => $type,
				'url' => $title,
			));
			if ($this->_model === null)
			{
				Yii::log("Library item with title $title in category $type is not found",
					'error', 'application.controllers.LibraryController');
				throw new CHttpException(404, 'Страница не найдена.');
			}
			Yii::app()->cache->set($cacheId, $this->_model, 3600);
		}
		return $this->_model;
	}
}
