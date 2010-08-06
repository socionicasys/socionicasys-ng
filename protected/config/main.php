<?php

$commonName = dirname(__FILE__) . '/common.php';
$localName = dirname(__FILE__) . '/local.php';

$commonConfig = require($commonName);
if (file_exists($localName))
{
	$localConfig = require($localName);
}
else
{
	$localConfig = array();
}

return CMap::mergeArray($localConfig, $commonConfig);
