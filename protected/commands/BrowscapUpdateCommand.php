<?php

/**
 * Консольная команда для обновления файла браузеров Browscap
 */
class BrowscapUpdateCommand extends CConsoleCommand
{
	/**
	 * Собственнно, код команды
	 * @param array $args параметры командной строки
	 */
	public function run($args)
	{
		Yii::import('application.vendors.phpbrowscap.browscap.Browscap');
		$userAgent = 'PhpBrowscap Updater';
		if (version_compare(PHP_VERSION, '5.3.0') >= 0)
		{
			stream_context_set_default(array(
				'http' => array(
					'user_agent' => $userAgent,
				),
			));
		}
		else
		{
			ini_set('user_agent', $userAgent);
		}
		$browscap = new Browscap(Yii::app()->getRuntimePath());
		$browscap->updateCache();
	}
}
