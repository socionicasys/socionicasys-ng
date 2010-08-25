<?php

/**
 * Класс-наследник {@link CClientScript}, реализующий опцию автоматического
 * добавления timestamp (в формате ?YYYYMMDDhhmm) к адресам всех регистрируемых
 * CSS и JavaScript.
 * @author Grey Teardrop
 */
class TimestampClientScript extends CClientScript
{
	/**
	 * Registers a CSS file
	 * @param string URL of the CSS file
	 * @param string media that the CSS file should be applied to
	 * @param boolean добавлять ли к адресу CSS-файла штамп даты изменения
	 * @see CClientScript::registerCssFile()
	 */
	public function registerCssFile($url, $media='', $timestamp=true)
	{
		if ($timestamp)
		{
			$url = $this->appendTimestamp($url);
		}
		parent::registerCssFile($url, $media);
	}
	
	/**
	 * Registers a javascript file
	 * @param string URL of the javascript file
	 * @param integer the position of the JavaScript code
	 * @param boolean добавлять ли к адресу javascript-файла штамп даты изменения
	 * @see CClientScript::registerScriptFile()
	 */
	public function registerScriptFile($url, $position=CClientScript::POS_HEAD, $timestamp=true)
	{
		if ($timestamp)
		{
			$url = $this->appendTimestamp($url);
		}
		parent::registerScriptFile($url, $position);
	}
	
	/**
	 * Добавляет к заданому $url метку в формате ?YYYYMMDDhhmm на основе даты
	 * модификации соответствующего файла.  
	 * @param string $url исходный адрес
	 * @return string адрес с добавленым timestamp.
	 */
	public function appendTimestamp($url)
	{
		$baseUrl = Yii::app()->getRequest()->getBaseUrl() . '/';
		// Добавляем timestamp только если адрес не содержит http:// и
		// принадлежит нашему приложению.
		if (strpos($url, $baseUrl) === 0)
		{
			$basePath = Yii::getPathOfAlias('webroot');
			$relativeUrl = substr($url, strlen($baseUrl) - 1);
			$resourcePath = $basePath . str_replace('/', DIRECTORY_SEPARATOR,
				$relativeUrl);
			if (file_exists($resourcePath))
			{
				$timestamp = date('?YmdHi', filemtime($resourcePath));
				return $url . $timestamp;
			}
		}
		return $url;
	}
}
