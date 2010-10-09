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
		$paramNames = array('name', 'file', 'f', 't', 'p', 'start', 'master', 'page');
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
			$group = $params['master'];
			$page = $params['page'];
			$redirect = RedirectModel::model()->findByAttributes(array(
				'group' => $group,
				'page' => $page,
			));
			if ($redirect !== null)
			{
				$modelClass = $redirect->model_class;
				$modelId = $redirect->model_id;
				$model = CActiveRecord::model($modelClass)->FindByPk($modelId);
				$url = $model->getUrl();
			}
		}
		else if ($params['name'] === 'Forums')
		{
			$possibleFiles = array('index', 'viewforum', 'viewtopic');
			$file = $params['file'];
			if (in_array($file, $possibleFiles))
			{
				foreach ($paramNames as $paramName)
				{
					if ($params[$paramName] === '')
					{
						unset($params[$paramName]);
					}
				}
				unset($params['file']);
				unset($params['name']);
				
				$query = Yii::app()->urlManager->createPathInfo($params, '=', '&');
				if ($query !== null && $query !== '')
				{
					$query = '?' . $query;
				}
				
				$hash = parse_url(Yii::app()->request->url, PHP_URL_FRAGMENT);
				if ($hash !== null && $hash !== '')
				{
					$hash = '#' . $hash;
				}
				
				$url = "/forum/$file.php$query$hash"; 
			}
			else
			{
				$url = '/forum/';
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
