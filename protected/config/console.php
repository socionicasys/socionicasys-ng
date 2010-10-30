<?php

$localName = dirname(__FILE__) . '/console-local.php';

if (file_exists($localName))
{
	$localConfig = require($localName);
}
else
{
	$localConfig = array();
}

return CMap::mergeArray($localConfig, array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'socionicasys-ng',
	'commandMap' => array(
		'migrate' => array(
			'class' => 'ext.yii-dbmigrations.CDbMigrationCommand',
		),
	),
	'preload' => array('log'),
	'components' => array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'logFile' => 'console.log',
				),
			),
		),
	),
));
