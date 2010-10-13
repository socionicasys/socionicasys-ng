<?php

class HtmlPurifierSetup
{
	public static function filter($text)
	{
		$purifier = new CHtmlPurifier();
		$purifier->options = array(
			'Attr.EnableID' => true,
		);
		return $purifier->purify($text);
	}
}
