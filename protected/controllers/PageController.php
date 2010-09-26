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
	
	public function actions() {
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
		);
	}

	public function actionManage()
	{
		$this->render('manage');
	}

	public function actionView($path = '/')
	{
		if (strpos($path, '/') !== 0)
		{
			$path = '/' . $path;
		}
		
		$page = Nav::model()->findByAttributes(array(
			'url' => $path
		));
		if ($page === null)
		{
			Yii::log("Unable to find page $path", 'error', 'application.controllers.PageController');
			throw new CHttpException(404, 'Страница не найдена');
		}
		
		$webUser = Yii::app()->user;
		$links = array();
		$pageControls = false;
		$path = trim($path, '/');
		if ($webUser->checkAccess('Page.Manage'))
		{
			$links['manage'] = $this->createUrl('manage');
		}
		if ($webUser->checkAccess('Page.Create'))
		{
			$links['create'] = $this->createUrl('create', array(
				'id' => $page->id,
			));
			$pageControls = true;
		}
		if ($webUser->checkAccess('Page.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'path' => $path,
			));
			$pageControls = true;
		}
		if ($webUser->checkAccess('Page.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'path' => $path,
			));
			$pageControls = true;
		}
		
		if ($page->title !== null)
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
		$this->layout = '//layouts/article';
		$this->render('view', array(
			'text' => $page->text,
			'links' => $links,
			'pageControls' => $pageControls,
		));
	}
	
	public function actionCreate($path = '/')
	{
		
	}

	public function actionEdit($path = '/')
	{
		
	}

	public function actionDelete($path = '/')
	{
		
	}
}
