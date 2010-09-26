<?php

class PageController extends Controller
{
	public $layout = '//layouts/section';
	public $defaultAction = 'view';
	
	public function behaviors()
	{
		return array(
			'EJNestedTreeActions' => array(
				'class' => 'ext.EJNestedTreeActions.EBehavior',
				'classname' => 'Nav',
				'identity' => 'id',
				'text' => 'menu_title',
				'defaultNodeName' => 'Новая страница',
			),
		);
	}
	
	public function actions() {
		return array (
			'render' => 'ext.EJNestedTreeActions.actions.Render',
			'createnode' => 'ext.EJNestedTreeActions.actions.Createnode',
			'renamenode' => 'ext.EJNestedTreeActions.actions.Renamenode',
			'deletenode' => 'ext.EJNestedTreeActions.actions.Deletenode',
			'movenode' => 'ext.EJNestedTreeActions.actions.Movenode',
			'copynode' => 'ext.EJNestedTreeActions.actions.Copynode',
			'createroot' => 'ext.EJNestedTreeActions.actions.Createroot',
		);
	}
	
	public function filters()
	{
		return array(
			'rights - view',
		);
	}

	public function actionManage()
	{
		$this->render('manage');
	}

	public function actionView($path = '/')
	{
		$page = $this->loadModel($path);
		$path = trim($path, '/');
		
		$webUser = Yii::app()->user;
		$links = array();
		$pageControls = false;
		if ($webUser->checkAccess('Page.Manage'))
		{
			$links['manage'] = $this->createUrl('manage');
		}
		if ($webUser->checkAccess('Page.Create'))
		{
			$links['create'] = $this->createUrl('create', array(
				'id' => $page->id,
			));
			$pageControls = true;
		}
		if ($webUser->checkAccess('Page.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'path' => $path,
			));
			$pageControls = true;
		}
		if ($webUser->checkAccess('Page.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'path' => $path,
			));
			$pageControls = true;
		}
		
		if ($page->title !== null)
		{
			$this->pageTitle = $page->title . ' | ' . Yii::app()->name;
		}
		else
		{
			$this->pageTitle = Yii::app()->name;
		}
		
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->baseUrl . '/scripts/hyphenate.js'
		);
		$this->layout = '//layouts/article';
		$this->render('view', array(
			'text' => $page->text,
			'links' => $links,
			'pageControls' => $pageControls,
		));
	}
	
	public function actionCreate($id = null)
	{
		$model = new Nav;
		if ($id === null)
		{
			// Если корень не указан, делаем страницу страницей первого уровня
			$id = 1;
		}
		
		if (isset($_POST['Nav']))
		{
			$model->attributes = $_POST['Nav'];
			$parent = Nav::model()->findByPk($id);
			if (empty($model->url))
			{
				$model->url = '/' . trim($parent->url, '/') . '/' .
					$this->rus2translit($model->menu_title);
			}
			$model->appendTo($parent);
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}
		
		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionEdit($path = '/')
	{
		$model = $this->loadModel($path);
		$path = trim($path, '/');

		if (isset($_POST['Nav']))
		{
			$model->attributes = $_POST['Nav'];
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => $path));
			}
		}
		
		$this->render('edit', array(
			'model' => $model,
		));
	}

	public function actionDelete($path = '/')
	{
		$page = $this->loadModel($path);
	}
	
	/**
	 * Загружает модель страницы по ее адресу
	 * @param $path string адрес страницы
	 * @return Nav модель страницы
	 */
	protected function loadModel($path = '/')
	{
		if (strpos($path, '/') !== 0)
		{
			$path = '/' . $path;
		}
		
		$model = Nav::model()->findByAttributes(array(
			'url' => $path
		));
		if ($model === null)
		{
			Yii::log("Unable to find page $path", 'error', 'application.controllers.PageController');
			throw new CHttpException(404, 'Страница не найдена');
		}

		return $model;
	}
	
	/**
	 * Функция необратимой транслитерации для SEO.
	 * Текст в таком транслите утрачивает однозначность и восстановлению не поделижит,
	 * (при этом всё-таки сохраняя читабельность для посетителей сайта)
	 * так же как *не может* быть напрямую использован как уникальный идентификатор
	 * при соответствующем ограничении наложенном на кириллический заголовок.
	 * Данную проблему можно решить двумя путями - ставить ограничение именно на
	 * транслитерированный заголовок, для чего завести в базе соответствующее поле,
	 * либо дополнять ссылку реальным идентификатором.
	 *
	 * Но при всех недостатках этот транслит понятен поисковикам
	 * и послужит дополнительным бонусом при ранжировании поисковой
	 * выдачи (за некоторыми исключениями, описанными в этой статье:
	 * http://blessmaster.livejournal.com/115715.html
	 *
	 * @param string $text текст для транслитерации
	 * @return string транслитерированную строку
	 * @author BlessMaster (deep-dream@ya.ru)
	 */
	public function rus2translit($text)
	{
		$text = mb_strtoupper($text, 'UTF-8');
	
		$exchange = array(
			'А'=>'a',
			'Б'=>'b',
			'В'=>'v',
			'Г'=>'g',
			'Д'=>'d',
			'Е'=>'e',
			'Ё'=>'e',
			'Ж'=>'zh',
			'З'=>'z',
			'И'=>'i',
			'Й'=>'j',
			'К'=>'k',
			'Л'=>'l',
			'М'=>'m',
			'Н'=>'n',
			'О'=>'o',
			'П'=>'p',
			'Р'=>'r',
			'С'=>'s',
			'Т'=>'t',
			'У'=>'u',
			'Ф'=>'f',
			'Х'=>'h',
			'Ц'=>'c',
			'Ч'=>'ch',
			'Ш'=>'sh',
			'Щ'=>'shch',
			'Ъ'=>'',
			'Ы'=>'y',
			'Ь'=>'',
			'Э'=>'e',
			'Ю'=>'ju',
			'Я'=>'ja',
			' '=>'-', // сохраняем пробел от перехода в %20 понятным гуглу способом
			','=>'',
			"'"=>'-',
		);
		$text = str_replace(array_keys($exchange), array_values($exchange), $text);
		// Остальные символы - уже никуда не денешься
		$text = rawurlencode($text);
		return $text;
	}
}
