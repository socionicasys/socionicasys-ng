<?php

/**
 * Виджет для сбора статистики посещения через Яндекс.Метрика 
 */
class YandexMetrika extends CWidget
{
	public function run()
	{
		$appParams = Yii::app()->params;
		if (isset($appParams['yandex.metrika']))
		{
			$this->render('yandex-metrika', array(
				'id' => $appParams['yandex.metrika'],
			));
		}
	}
}
