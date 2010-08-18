<?php

class GoogleAnalytics extends CWidget
{
	public function run()
	{
		$appParams = Yii::app()->params;
		if (isset($appParams['google.analytics']))
		{
			$this->render('tracking', array(
				'id' => $appParams['google.analytics'],
			));
		}
	}
}
