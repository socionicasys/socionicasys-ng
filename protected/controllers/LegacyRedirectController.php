<?php

/**
 * Контроллер, перенаправляющие ссылки на страницы старого сайта на их аналоги
 * на новом сайте.
 * @author Grey Teardrop
 */
class LegacyRedirectController extends Controller
{
	/**
	 * Перенаправление (некоторых) ссылок в формате движка phpNuke.
	 */
	public function actionNuke()
	{
		Yii::log('Redirecting from ' .  Yii::app()->request->url, 'info');
		
		$params = array();
		$paramNames = array('name', 'file', 'f', 't', 'p', 'group', 'page');
		foreach ($paramNames as $paramName)
		{
			if (isset($_GET[$paramName]))
			{
				$params[$paramName] = $_GET[$paramName];
			}
			else
			{
				$params[$paramName] = '';
			}
		}
		
		$url = null;
		if ($params['name'] === 'InfoPages')
		{
			// Раздел «Теория» старого сайта
			$group = $params['group'];
			$page = $params['page'];
			if ($group === '')
			{
				$url = array('static/view', 'path' => 'teorija');
			}
			else if ($group === '1')
			{
				if ($page === '')
				{
					$url = array('static/view', 'path' => 'teorija/sistemnyj-podhod');
				}
				else if ($page === '23')
				{
					$url = array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistema');
				}
				else if ($page === '26')
				{
					$url = array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistemnye-principy');
				}
			}
			else if ($group === '9')
			{
				$url = array('static/view', 'path' => 'teorija/aspekty');
			}
			else if ($group === '10')
			{
				if ($page === '')
				{
					$url = array('static/view', 'path' => 'teorija/model-tima');
				}
			}
		}
		
		if ($url !== null)
		{
			Yii::log('Redirecting to ' . CVarDumper::dumpAsString($url), 'info');
			$this->redirect($url, true, 301);
		}
		else
		{
			Yii::log('No redirect forund for ' . Yii::app()->request->url, 'warning');
			$this->redirect(Yii::app()->homeUrl);
		}
	}
}
