<?php

class PageController extends Controller
{
	public $layout = '//layouts/section';
	public $defaultAction = 'view';
	
	public function behaviors()
	{
		return array(
			'EJNestedTreeActions' => array(
				'class' => 'ext.EJNestedTreeActions.EBehavior',
				'classname' => 'Nav',
				'identity' => 'id',
				'text' => 'menu_title',
				'defaultNodeName' => 'Новая страница',
			),
		);
	}
	
	public function actions()
	{
		return array (
			'render' => 'ext.EJNestedTreeActions.actions.Render',
			'createnode' => 'ext.EJNestedTreeActions.actions.Createnode',
			'renamenode' => 'ext.EJNestedTreeActions.actions.Renamenode',
			'deletenode' => 'ext.EJNestedTreeActions.actions.Deletenode',
			'movenode' => 'ext.EJNestedTreeActions.actions.Movenode',
			'copynode' => 'ext.EJNestedTreeActions.actions.Copynode',
			'createroot' => 'ext.EJNestedTreeActions.actions.Createroot',
		);
	}
	
	public function filters()
	{
		return array(
			'rights - view',
			array(
				'SpaceFixer',
			),
		);
	}

	public function actionManage()
	{
		$this->layout = '//layouts/section-wide';
		$this->render('manage');
	}

	public function actionView($path = '/')
	{
		$page = $this->loadModel($path);
		$path = trim($path, '/');
		
		$webUser = Yii::app()->user;
		$links = array();
		$pageControls = false;
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Manage'))
		{
			$links['manage'] = $this->createUrl('manage');
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Create'))
		{
			$links['create'] = $this->createUrl('create', array(
				'id' => $page->id,
			));
			$pageControls = true;
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'path' => $path,
			));
			$pageControls = true;
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'path' => $path,
			));
			$pageControls = true;
		}

		if ($page->title === null)
		{
			$this->pageTitle = $page->menu_title . ' | ' . Yii::app()->name;
		}
		else if (!empty($page->title))
		{
			$this->pageTitle = $page->title . ' | ' . Yii::app()->name;
		}
		else
		{
			$this->pageTitle = Yii::app()->name;
		}
		
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->baseUrl . '/scripts/hyphenate.js'
		);
		if ($page->wide_layout)
		{
			$this->layout = '//layouts/article-wide'; 
		}
		else
		{
			$this->layout = '//layouts/article';
		}
		$this->render('view', array(
			'text' => $page->text,
			'links' => $links,
			'pageControls' => $pageControls,
		));
	}
	
	public function actionCreate($id = null)
	{
		$model = new Nav;
		if ($id === null)
		{
			// Если корень не указан, делаем страницу страницей первого уровня
			$id = 1;
		}
		
		if (isset($_POST['Nav']))
		{
			$model->attributes = $_POST['Nav'];
			$parent = Nav::model()->findByPk($id);
			$model->appendTo($parent);
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}
		
		$this->layout = '//layouts/section-wide';
		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionEdit($path = '/')
	{
		$model = $this->loadModel($path);

		if (isset($_POST['Nav']))
		{
			$model->attributes = $_POST['Nav'];
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}
		
		$this->layout = '//layouts/section-wide';
		$this->render('edit', array(
			'model' => $model,
		));
	}

	public function actionDelete($path = '/')
	{
		$model = $this->loadModel($path);
		
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->deleteNode();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->homeUrl);
			}
			else
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}
		
		$this->render('delete', array(
			'model' => $model,
		));
	}
	
	/**
	 * Загружает модель страницы по ее адресу
	 * @param $path string адрес страницы
	 * @return Nav модель страницы
	 */
	protected function loadModel($path = '/')
	{
		if (strpos($path, '/') !== 0)
		{
			$path = '/' . $path;
		}
		
		$model = Nav::model()->findByAttributes(array(
			'url' => $path
		));
		if ($model === null)
		{
			Yii::log("Unable to find page $path", 'error', 'application.controllers.PageController');
			throw new CHttpException(404, 'Страница не найдена');
		}

		return $model;
	}
}
