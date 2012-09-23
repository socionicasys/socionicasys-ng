<?php

Yii::import('application.vendors.phpbrowscap.browscap.src.Browscap');

/**
 * (Временный) обход бага Оперы с некорректным отображением &amp;thinsp;
 * @author Grey Teardrop
 */
class SpaceFixer extends COutputProcessor
{
	public function processOutput($output)
	{
		$cachedir = Yii::app()->getRuntimePath();
		try
		{
			$browscap = new \phpbrowscap\Browscap($cachedir);
			$browscap->doAutoUpdate = false;
			$browser = $browscap->getBrowser();
			if ($browser->Browser === 'Opera')
			{
				$output = str_replace(array('&thinsp;', ' '), ' ', $output);
			}
		}
		catch (\phpbrowscap\Exception $e)
		{
			// Если не удалось создать объект Browscap или опознать браузер, не применяем фильтрацию
		}
		parent::processOutput($output);
	}
}
