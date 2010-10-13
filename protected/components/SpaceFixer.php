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
		$cachedir = Yii::getPathOfAlias('application.runtime');
		$browscap = new Browscap($cachedir);
		$browser = $browscap->getBrowser();
		if ($browser->Browser === 'Opera')
		{
			$output = str_replace('&thinsp;', ' ', $output);
		}
		parent::processOutput($output);
	}
}
