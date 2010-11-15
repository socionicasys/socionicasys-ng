<?php

/**
 * Компонент, сохраняющий информацию о производительности обработки запросов в логи
 */
class PerformanceLogger extends CApplicationComponent
{
	public function init()
	{
		Yii::app()->attachEventHandler('onEndRequest', array($this, 'logPerformance'));
	}

	public function logPerformance()
	{
		$logger = Yii::getLogger();
		$message = 'Request to ' . Yii::app()->getRequest()->getUrl() . " finished\n";
		$message .= 'Execution time: ' . $logger->getExecutionTime() . " s\n";
		$message .= 'Memory used: ' . $logger->getMemoryUsage() / (1024*1024) . " MB\n";
		$logger->log($message, CLogger::LEVEL_INFO, 'application.components.PerformanceLogger');
	}
}
