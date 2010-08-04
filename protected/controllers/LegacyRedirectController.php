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
		$paramNames = array('name', 'file', 'f', 't', 'p', 'master', 'page');
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
					''   => array('static/view', 'path' => 'teorija/model-tima'),
					'32' => array('static/view', 'path' => 'teorija/model-tima/vital-mental'),
					'33' => array('static/view', 'path' => 'teorija/model-tima/rac-irrac'),
					'38' => array('static/view', 'path' => 'teorija/model-tima/extra-intro'),
					'41' => array('static/view', 'path' => 'teorija/model-tima/16-modelej'),
				),
				'12' => array(
					''   => array('static/view', 'path' => 'teorija/model-tima/funkcii'),
					'30' => array('static/view', 'path' => 'teorija/model-tima/funkcii/razmernosti'),
					'31' => array('static/view', 'path' => 'teorija/model-tima/funkcii/znaki'),
				),
				'2' => array(
					''   => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej'),
					'3'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ile'),
					'5'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sei'),
					'6'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ese'),
					'7'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lii'),
					'8'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/eie'),
					'9'  => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lsi'),
					'10' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sle'),
					'11' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/iei'),
					'12' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/see'),
					'13' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ili'),
					'14' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lie'),
					'15' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/esi'),
					'16' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lse'),
					'17' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/eii'),
					'18' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/iee'),
					'19' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sli'),
				),
				'13' => array(
					'' => array('static/view', 'path' => 'teorija/model-tima/kommunikativnye-modeli'),
				),
				'11' => array(
					'' => array('static/view', 'path' => 'teorija/otnoshenija'),
				),
				'14' => array(
					'' => array('static/view', 'path' => 'teorija/otnoshenija/diady'),
				),
				'15' => array(
					'' => array('static/view', 'path' => 'teorija/otnoshenija/kvadry'),
				),
				'16' => array(
					'' => array('static/view', 'path' => 'teorija/otnoshenija/kolca'),
				),
				'18' => array(
					'' => array('static/view', 'path' => 'teorija/i-timy'),
				),
				'19' => array(
					'' => array('static/view', 'path' => 'praktika/metodika'),
				),
				'21' => array(
					''   => array('static/view', 'path' => 'statji-doklady'),
					'45' => array('static/view', 'path' => 'statji-doklady'),
					'46' => array('static/view', 'path' => 'statji-doklady'),
					'47' => array('static/view', 'path' => 'statji-doklady'),
					'48' => array('static/view', 'path' => 'statji-doklady'),
					'49' => array('static/view', 'path' => 'statji-doklady'),
					'50' => array('static/view', 'path' => 'statji-doklady'),
					'51' => array('static/view', 'path' => 'statji-doklady'),
					'52' => array('static/view', 'path' => 'statji-doklady'),
					'53' => array('static/view', 'path' => 'statji-doklady'),
					'54' => array('static/view', 'path' => 'statji-doklady'),
					'55' => array('static/view', 'path' => 'statji-doklady'),
					'56' => array('static/view', 'path' => 'statji-doklady'),
					'57' => array('static/view', 'path' => 'statji-doklady'),
					'58' => array('static/view', 'path' => 'statji-doklady'),
					'59' => array('static/view', 'path' => 'statji-doklady'),
					'62' => array('static/view', 'path' => 'statji-doklady'),
					'63' => array('static/view', 'path' => 'statji-doklady'),
					'64' => array('static/view', 'path' => 'statji-doklady'),
					'65' => array('static/view', 'path' => 'statji-doklady'),
					'66' => array('static/view', 'path' => 'statji-doklady'),
					'67' => array('static/view', 'path' => 'statji-doklady'),
				),
				'24' => array(
					''   => array('static/view', 'path' => 'statji-doklady'),
					'68' => array('static/view', 'path' => 'statji-doklady'),
					'69' => array('static/view', 'path' => 'statji-doklady'),
					'70' => array('static/view', 'path' => 'statji-doklady'),
					'72' => array('static/view', 'path' => 'statji-doklady'),
					'73' => array('static/view', 'path' => 'statji-doklady'),
					'74' => array('static/view', 'path' => 'statji-doklady'),
				),
				'23' => array(
					'' => array('static/view', 'path' => 'statji-doklady'),
				),
			);

			$group = $params['master'];
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
