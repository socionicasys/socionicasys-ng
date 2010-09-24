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
		
		if ($page->title !== null)
		{
			$this->pageTitle = $page->title . ' | ' . Yii::app()->name;
		}
		else
		{
			$this->pageTitle = Yii::app()->name;
		}
		
		$this->layout = '//layouts/article';
		$this->renderText($page->text);
	}
}
