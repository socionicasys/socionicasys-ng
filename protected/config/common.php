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
				'novosti' => 'news/list',
				'novosti/<News_page:\d+>' => 'news/list',
				'novosti/statja/<id:\d+>' => 'news/item',
				'novosti/statja/<id:\d+>/edit' => 'news/edit',
				'novosti/statja/<id:\d+>/delete' => 'news/delete',
				'novosti/create' => 'news/create',
				'atom.xml' => 'news/feed',
				// Обработка pull-запросов с GitHub
				'git/pull/<id:\w+>' => 'git/pull',
				// Модуль Rights
				'rights' => 'rights',
				'rights/<controller:\w+>/<id:\d+>' => 'rights/<controller>/view',
				'rights/<controller:\w+>/<action:\w+>/<id:\d+>' => 'rights/<controller>/<action>',
				'rights/<controller:\w+>/<action:\w+>' => 'rights/<controller>/<action>',
				// Все адреса, не обработанные выше, отображаются с помощью
				// контроллера StaticController
				'<path:.*>' => array('static/view', 'keepSlashes' => true),
				// Заглавная страница отображается статично
				'/' => 'static/view',
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
			'pageTree' => 'pageTree',
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
	
	'controllerMap' => array(
		'redactor' => 'ext.imperavi.RedactorController',
	),
	
	'modules' => array(
		'rights' => array(
			'install' => false,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'pageTree' => array(
			'items' => array(
				array(
					'label' => 'Главная',
					'url' => array('static/view'),
					'items' => array(
						array(
							'label' => 'История соционики',
							'url' => array('static/view', 'path' => 'istorija-socioniki'),
						),
						array(
							'label' => 'О Школе системной соционики',
							'url' => array('static/view', 'path' => 'o-shkole'),
						),
						array(
							'label' => 'Новости',
							'url' => array('news/list'),
						),
						array(
							'label' => 'Контакты',
							'url' => array('static/view', 'path' => 'kontakty'),
						),
					),
				),
				array(
					'label' => 'Теория',
					'url' => array('static/view', 'path' => 'teorija'),
					'items' => array(
						array(
							'label' => 'Соционика для новичков',
							'url' => array('static/view', 'path' => 'teorija/socionika-dlja-novichkov'),
							'items' => array(
								array(
									'label' => 'Что такое соционика?',
									'url' => array('static/view', 'path' => 'teorija/socionika-dlja-novichkov/chto-takoe-socionica'),
								),
								array(
									'label' => 'Системный подход',
									'url' => array('static/view', 'path' => 'teorija/socionika-dlja-novichkov/sistemy'),
								),
								array(
									'label' => 'Информационные аспекты',
									'url' => array('static/view', 'path' => 'teorija/socionika-dlja-novichkov/aspekty'),
								),
								array(
									'label' => 'Модель ТИМа',
									'url' => array('static/view', 'path' => 'teorija/socionika-dlja-novichkov/model'),
								),
							),
						),
						array(
							'label' => 'Системный подход',
							'url' => array('static/view', 'path' => 'teorija/sistemnyj-podhod'),
							'items' => array(
								array(
									'label' => 'Система',
									'url' => array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistema'),
								),
								array(
									'label' => 'Системные принципы',
									'url' => array('static/view', 'path' => 'teorija/sistemnyj-podhod/sistemnye-principy'),
								),
							),
						),
						array(
							'label' => 'Деление информации на аспекты',
							'url' => array('static/view', 'path' => 'teorija/aspekty'),
						),
						array(
							'label' => 'Модель ТИМa',
							'url' => array('static/view', 'path' => 'teorija/model-tima'),
							'items' => array(
								array(
									'label' => 'Функции',
									'url' => array('static/view', 'path' => 'teorija/model-tima/funkcii'),
									'items' => array(
										array(
											'label' => 'Размерность функций',
											'url' => array('static/view', 'path' => 'teorija/model-tima/funkcii/razmernosti'),
										),
										array(
											'label' => 'Знаки функций',
											'url' => array('static/view', 'path' => 'teorija/model-tima/funkcii/znaki'),
										),
									),
								),
								array(
									'label' => 'Описание моделей ТИМа',
									'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej'),
									'items' => array(
										array(
											'label' => 'ИЛЭ («Дон Кихот»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ile'),
										),
										array(
											'label' => 'СЭИ («Дюма»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sei'),
										),
										array(
											'label' => 'ЭСЭ («Гюго»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ese'),
										),
										array(
											'label' => 'ЛИИ («Робеспьер»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lii'),
										),
										array(
											'label' => 'ЭИЭ («Гамлет»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/eie'),
										),
										array(
											'label' => 'ЛСИ («Максим Горький»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lsi'),
										),
										array(
											'label' => 'СЛЭ («Жуков»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sle'),
										),
										array(
											'label' => 'ИЭИ («Есенин»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/iei'),
										),
										array(
											'label' => 'ИЛИ («Бальзак»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/ili'),
										),
										array(
											'label' => 'ЛИЭ («Джек Лондон»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lie'),
										),
										array(
											'label' => 'ЭСИ («Драйзер»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/esi'),
										),
										array(
											'label' => 'ЛСЭ («Штирлиц»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/lse'),
										),
										array(
											'label' => 'ЭИИ («Достоевский»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/eii'),
										),
										array(
											'label' => 'ИЭЭ («Гексли»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/iee'),
										),
										array(
											'label' => 'СЛИ («Габен»)',
											'url' => array('static/view', 'path' => 'teorija/model-tima/opisanije-modelej/sli'),
										),
									),
								),
								array(
									'label' => 'Суперблоки Витал и Ментал',
									'url' => array('static/view', 'path' => 'teorija/model-tima/vital-mental'),
								),
								array(
									'label' => 'Экстраверсия/интроверсия',
									'url' => array('static/view', 'path' => 'teorija/model-tima/extra-intro'),
								),
								array(
									'label' => '(Ир-)рациональность',
									'url' => array('static/view', 'path' => 'teorija/model-tima/rac-irrac'),
								),
							),
						),
						array(
							'label' => 'Межтипные отношения',
							'url' => array('static/view', 'path' => 'teorija/otnoshenija'),
							'items' => array(
								array(
									'label' => 'Диады',
									'url' => array('static/view', 'path' => 'teorija/otnoshenija/diady'),
								),
								array(
									'label' => 'Квадры',
									'url' => array('static/view', 'path' => 'teorija/otnoshenija/kvadry'),
								),
								array(
									'label' => 'Кольца',
									'url' => array('static/view', 'path' => 'teorija/otnoshenija/kolca'),
								),
							),
						),
						array(
							'label' => 'Интегральные ТИМы',
							'url' => array('static/view', 'path' => 'teorija/i-timy'),
						),
					),
				),
				array(
					'label' => 'Практика определения ТИМа',
					'url' => array('static/view', 'path' => 'praktika'),
					'items' => array(
						array(
							'label' => 'Методика типирования',
							'url' => array('static/view', 'path' => 'praktika/metodika'),
						),
					),
				),
				array(
					'label' => 'Статьи, доклады',
					'url' => array('static/view', 'path' => 'statji-doklady'),
					'items' => array(
					),
				),
				array(
					'label' => 'Форум',
					'url' => '/forum/',
				),
			),
		),
	),
);
