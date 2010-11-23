<?php

Yii::import('application.vendors.HTMLPurifier.HTMLPurifier_Filter_MyIframe');

class HtmlPurifierSetup
{
	public static function filter($text)
	{
		$purifier = new CHtmlPurifier();
		$purifier->options = array(
			'Attr.EnableID' => true,
			'HTML.SafeEmbed' => true,
			'HTML.SafeObject' => true,
			'HTML.Trusted' => true,
			'Output.FlashCompat' => true,
			'Filter.Custom' => array(
				new HTMLPurifier_Filter_MyIframe(),
			),
		);
		return $purifier->purify($text);
	}
}
