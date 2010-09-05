<?php

class StaticController extends Controller
{
	public $layout = '//layouts/article';
	public $defaultAction = 'view';

	public function actionView($path = 'index')
	{
		if ($path === '')
		{
			$path = 'index';
		}
		try
		{
			Yii::app()->clientScript->registerScriptFile(
				Yii::app()->baseUrl . '/scripts/hyphenate.js'
			);
			$this->render($path);
		}
		catch (CException $e)
		{
			Yii::log("Unable to find page /$path", 'error', 'application.controllers.StaticController');
			throw new CHttpException(404, $e->getMessage());
		}
	}
}
