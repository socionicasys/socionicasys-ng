<?php

class StaticController extends Controller
{
	public $defaultAction = 'view';

	public function actionView()
	{
		if (isset($_GET['path']))
		{
			$path = $_GET['path'];
		}
		else
		{
			$path = 'index';
		}
		$path = trim($path, '/');
		$view = strtr($path, '/', '.');
		$this->render($view);
	}
}
