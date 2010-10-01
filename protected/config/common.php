<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Школа системной соционики',
	'sourceLanguage' => 'ru',
	'defaultController' => 'static',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.rights.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'RightsWebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('site/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'class' => 'CustomUrlManager',
			'urlFormat'=>'path',
			'showScriptName' => false,
			'useStrictParsing' => true,
			'rules'=>array(
				// Перенаправление старых адресов
				'modules.php' => 'legacyRedirect/nuke',
				// Вход-выход с сайта
				'login' => 'site/login',
				'logout' => 'site/logout',
				// Новости
				'novosti/<News_page:\d+>' => 'news/list',
				'novosti' => 'news/list',
				'novosti/statja/<id:\d+>' => 'news/item',
				'novosti/statja/<id:\d+>/edit' => 'news/edit',
				'novosti/statja/<id:\d+>/delete' => 'news/delete',
				'novosti/create' => 'news/create',
				'atom.xml' => 'news/feed',
				// Библиотека: статьи, доклады, и т. п.
				'biblioteka/<type:(statji)>/create' => 'library/create',
				'biblioteka/<type:(statji)>/<title:(\w|-)+>/edit' => 'library/edit',
				'biblioteka/<type:(statji)>/<title:(\w|-)+>/delete' => 'library/delete',
				'biblioteka/<type:(statji)>/<title:(\w|-)+>' => 'library/view',
				'biblioteka/<type:(statji)>' => 'library/list',
				// Обработка pull-запросов с GitHub
				'git/pull/<id:\w+>' => 'git/pull',
				// Модуль Rights
				'rights' => 'rights',
				'rights/<controller:\w+>/<id:\d+>' => 'rights/<controller>/view',
				'rights/<controller:\w+>/<action:\w+>/<id:\d+>' => 'rights/<controller>/<action>',
				'rights/<controller:\w+>/<action:\w+>' => 'rights/<controller>/<action>',
				// Управление страницами
				'page/create/<id:\d+>' => 'page/create',
				'page/<action:(manage|create|render|createnode|renamenode|deletenode|movenode|copynode|createroot)>' => 'page/<action>',
				'edit' => array('page/edit', 'defaultParams' => array('path' => '')),
				'delete' => array('page/delete', 'defaultParams' => array('path' => '')),
				'<path:.+>/edit' => array('page/edit', 'keepSlashes' => true),
				'<path:.+>/delete' => array('page/delete', 'keepSlashes' => true),
				'<path:.*>' => array('page/view', 'keepSlashes' => true),
				'/' => 'page/view',
			),
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info, debug',
				),
			),
		),
		'clientScript' => array(
			'class' => 'TimestampClientScript',
		),
		'menuManager' => array(
			'class' => 'MenuManager',
		),
		'authManager' => array(
			'class'           => 'RightsAuthManager',
			'connectionID'    => 'db',
			'assignmentTable' => '{{auth_assignment}}',
			'itemTable'       => '{{auth_item}}',
			'itemChildTable'  => '{{auth_item_child}}',
			'itemWeightTable' => '{{auth_item_weight}}',
		),
	),
	
	'modules' => array(
		'rights' => array(
			'install' => false,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
	),
);
