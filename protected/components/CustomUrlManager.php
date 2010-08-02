<?php

/**
 * CustomUrlManager — модифицированная версия CUrlManager.
 * 
 * Добавлен новый параметр $keepSlashes, позволяющий параметрам охватывать
 * несколько частей адреса между /
 * 
 * @author Grey Teardrop
 */
class CustomUrlManager extends CUrlManager
{
	/**
	 * @var boolean сохранять ли слеши в параметрах при преобразовании путей в
	 * адреса. 
	 */
	public $keepSlashes = false;
	
	protected function createUrlRule($route, $pattern)
	{
		return new CustomUrlRule($route, $pattern);
	}
}

/**
 * CustomUrlRule — модифицированная версия CUrlRule.
 * @author Grey Teardrop
 *
 */
class CustomUrlRule extends CUrlRule
{
	public $keepSlashes;
	
	public function __construct($route, $pattern)
	{
		if (is_array($route))
		{
			if (isset($route['keepSlashes']))
			{
				$this->keepSlashes = $route['keepSlashes'];
			}
		}
		parent::__construct($route, $pattern);
	}
	
	public function createUrl($manager, $route, $params, $ampersand)
	{
		if($manager->caseSensitive && $this->caseSensitive===null || $this->caseSensitive)
			$case='';
		else
			$case='i';

		$tr=array();
		if($route!==$this->route)
		{
			if($this->routePattern!==null && preg_match($this->routePattern.$case,$route,$matches))
			{
				foreach($this->references as $key=>$name)
					$tr[$name]=$matches[$key];
			}
			else
				return false;
		}

		foreach($this->defaultParams as $key=>$value)
		{
			if(isset($params[$key]) && $params[$key]==$value)
				unset($params[$key]);
			else
				return false;
		}

		foreach($this->params as $key=>$value)
			if(!isset($params[$key]))
				return false;

		if($manager->matchValue && $this->matchValue===null || $this->matchValue)
		{
			foreach($this->params as $key=>$value)
			{
				if(!preg_match('/'.$value.'/'.$case,$params[$key]))
					return false;
			}
		}

		foreach($this->params as $key=>$value)
		{
			if ($manager->keepSlashes && $this->keepSlashes === null || $this->keepSlashes)
			{
				$encoded_param = implode('/', array_map('urlencode', explode('/', $params[$key])));
			}
			else
			{
				$encoded_param = urlencode($params[$key]);
			}
			$tr["<$key>"] = $encoded_param;
			unset($params[$key]);
		}

		$suffix=$this->urlSuffix===null ? $manager->urlSuffix : $this->urlSuffix;

		$url=strtr($this->template,$tr);

		if($this->hasHostInfo)
		{
			$hostInfo=Yii::app()->getRequest()->getHostInfo();
			if(strpos($url,$hostInfo)===0)
				$url=substr($url,strlen($hostInfo));
		}

		if(empty($params))
			return $url!=='' ? $url.$suffix : $url;

		if($this->append)
			$url.='/'.$manager->createPathInfo($params,'/','/').$suffix;
		else
		{
			if($url!=='')
				$url.=$suffix;
			$url.='?'.$manager->createPathInfo($params,'=',$ampersand);
		}

		return $url;
	}
}
