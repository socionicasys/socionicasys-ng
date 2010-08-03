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
			$infoPages = array(
				'' => array(
					'' => array('static/view', 'path' => 'teorija'),
				),
				'1' => array(
					''   => array('static/view', 'path' => 'teorija/sistemnyj-podhod'),
					'23' => array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistema'),
					'26' => array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistemnye-principy'),
				),
				'9' => array(
					'' => array('static/view', 'path' => 'teorija/aspekty'),
				),
				'10' => array(
					'' => array('static/view', 'path' => 'teorija/model-tima'),
				),
			);

			$group = $params['group'];
			$page = $params['page'];
			if (isset($infoPages[$group]) && isset($infoPages[$group][$page]))
			{
				$url = $infoPages[$group][$page];
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
