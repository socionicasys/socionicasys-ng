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
	
	public function actions()
	{
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
			array(
				'SpaceFixer',
			),
			array(
				'COutputCache + view',
				'duration' => 86400,
				'varyByRoute' => true,
				'varyByParam' => array('path'),
			),
		);
	}

	public function renderSidebarLinks()
	{
		$webUser = Yii::app()->user;
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Manage'))
		{
			return $this->renderPartial('page-manage', array(
				'link' => $this->createUrl('manage'),
			), true);
		}
		else
		{
			return '';
		}
	}

	public function actionManage()
	{
		$this->layout = '//layouts/section-wide';
		$this->layoutClass = 'wide';
		$this->render('manage');
	}

	public function actionView($path = '/')
	{
		$model = $this->loadModel($path);
		
		if ($model->title === null)
		{
			$this->pageTitle = $model->menu_title . ' | ' . Yii::app()->name;
		}
		else if (!empty($model->title))
		{
			$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
		}
		else
		{
			$this->pageTitle = Yii::app()->name;
		}
		
		if ($model->meta_description !== null)
		{
			$this->pageDescription = $model->meta_description;
		}
		if ($model->meta_keywords !== null)
		{
			$this->pageKeywords = $model->meta_keywords;
		}

		$prevLink = null;
		$nextLink = null;
		if (!$model->standalone)
		{
			if ($model->type != Nav::TYPE_SECTION)
			{
				$section = $model->ancestors()->find(array(
					'condition' => 'type = ' . Nav::TYPE_SECTION,
					'order' => 'level DESC',
				));
				$prevPage = Nav::model()->find(array(
					'condition' => 'lft < ' . $model->lft,
					'order' => 'lft DESC',
				));
				if ($prevPage !== null && !($prevPage->isDescendantOf($section) || $prevPage->equals($section)))
				{
					$prevPage = null;
				}
			}
			else
			{
				$section = $model;
				$prevPage = null;
			}
			$nextPage = Nav::model()->find(array(
				'condition' => 'lft > ' . $model->lft,
				'order' => 'lft ASC',
			));
			if ($nextPage !== null && !($nextPage->isDescendantOf($section) || $nextPage->equals($section)))
			{
				$nextPage = null;
			}

			if ($prevPage !== null)
			{
				$prevLink = $prevPage->getUrl();
				Yii::app()->clientScript->registerLinkTag('prev', null, $prevLink);
			}
			if ($nextPage !== null)
			{
				$nextLink = $nextPage->getUrl();
				Yii::app()->clientScript->registerLinkTag('next', null, $nextLink);
			}
		}
		
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->baseUrl . '/scripts/hyphenate.js'
		);
		if ($model->wide_layout)
		{
			$this->layout = '//layouts/article-wide';
		}
		else
		{
			$this->layout = '//layouts/article';
		}
		$this->render('view', array(
			'model' => $model,
			'standalone' => $model->standalone,
			'prevLink' => $prevLink,
			'nextLink' => $nextLink,
		));
	}

	public function renderPageLinks($id, $path)
	{
		$path = trim($path, '/');
		$links = array();
		$webUser = Yii::app()->user;

		if (!$webUser->isGuest && $webUser->checkAccess('Page.Create'))
		{
			$links['create'] = $this->createUrl('create', array(
				'id' => $id,
			));
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'path' => $path,
			));
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Page.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'path' => $path,
			));
		}

		if (!empty($links))
		{
			return $this->renderPartial('page-links', array(
				'links' => $links,
			), true);
		}
		else
		{
			return '';
		}
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
			$model->appendTo($parent);
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}

		$this->layoutClass = 'wide';
		$this->layout = '//layouts/section-wide';
		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionEdit($path = '/')
	{
		$model = $this->loadModel($path);

		if (isset($_POST['Nav']))
		{
			$model->attributes = $_POST['Nav'];
			if ($model->saveNode())
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}

		$this->layoutClass = 'wide';
		$this->layout = '//layouts/section-wide';
		$this->render('edit', array(
			'model' => $model,
		));
	}

	public function actionDelete($path = '/')
	{
		$model = $this->loadModel($path);
		
		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->deleteNode();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->homeUrl);
			}
			else
			{
				$this->redirect(array('view', 'path' => trim($model->url, '/')));
			}
		}
		
		$this->render('delete', array(
			'model' => $model,
		));
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
}
