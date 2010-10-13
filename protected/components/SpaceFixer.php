<?php

Yii::import('application.vendors.phpbrowscap.browscap.Browscap');

/**
 * (Временный) обход бага Оперы с некорректным отображением &thinsp;
 * @author Grey Teardrop
 */
class SpaceFixer extends COutputProcessor
{
	public function processOutput($output)
	{
		$cachedir = Yii::app()->getRuntimePath();
		$browscap = new Browscap($cachedir);
		$browser = $browscap->getBrowser();
		if ($browser->Browser === 'Opera')
		{
			$output = str_replace(array('&thinsp;', ' '), ' ', $output);
		}
		parent::processOutput($output);
	}
}
