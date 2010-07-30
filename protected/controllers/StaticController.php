<?php

class StaticController extends Controller
{
	public $defaultAction = 'view';

	public function actionView()
	{
		$path = '';
		if (isset($_GET['path']))
		{
			$path = $_GET['path'];
		}
		if ($path === '')
		{
			$path = 'index';
		}
		$this->render($path);
	}
}
