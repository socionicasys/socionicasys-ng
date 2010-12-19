<?php

class VideoController extends Controller
{
	public $layout = '//layouts/section-wide';
	public $layoutClass = 'wide';

	private $_model;

	public function filters()
	{
		return array(
			'rights + create, edit, delete',
			array(
				'SpaceFixer',
			),
			array(
				'COutputCache + item, list',
				'duration' => 86400,
				'varyByRoute' => true,
				'varyByParam' => array('id'),
			),
		);
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$this->layout = '//layouts/article-wide';
		$this->render('view', array(
			'model' => $model,
		));
	}

	public function renderItemLinks($id)
	{
		$links = array();
		$webUser = Yii::app()->user;
		if (!$webUser->isGuest && $webUser->checkAccess('Video.Edit'))
		{
			$links['edit'] = $this->createUrl('edit', array(
				'id' => $id,
			));
		}
		if (!$webUser->isGuest && $webUser->checkAccess('Video.Delete'))
		{
			$links['delete'] = $this->createUrl('delete', array(
				'id' => $id,
			));
		}

		if (empty($links))
		{
			return '';
		}
		else
		{
			return $this->renderPartial('item-links', array(
				'links' => $links
			), true);
		}
	}

	public function renderVideo($link)
	{
		$matches = array();
		if (preg_match('#^http://(?:www\.)?youtube\.com/watch\?v=([0-9A-Za-z-_]{11})$#', $link, $matches) === 1)
		{
			$this->renderPartial('video-youtube', array(
				'id' => $matches[1],
			));
		}
		else if (preg_match('#^http://(?:www\.)?vimeo\.com/([0-9]+)$#', $link, $matches) === 1)
		{
			$this->renderPartial('video-vimeo', array(
				'id' => $matches[1],
			));
		}
		else if (preg_match('#http://vkontakte\.ru/video_ext\.php\?oid=([-0-9]+)&(?:amp;)?id=([-0-9]+)&(?:amp;)?hash=([0-9a-f]+)#', $link, $matches))
		{
			$this->renderPartial('video-vkontakte', array(
				'oid' => $matches[1],
				'id' => $matches[2],
				'hash' => $matches[3],
			));
		}
		else
		{
			$this->renderPartial('video-other', array(
				'link' => $link,
			));
		}
	}

	public function actionList()
	{
		$dataProvider = new CActiveDataProvider('Video', array(
			'sort' => array(
				'defaultOrder' => 'category ASC, date ASC, title ASC',
			),
			'pagination' => false,
		));

		$viewParameters = array(
			'dataProvider' => $dataProvider,
		);

		if (Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial('list', $viewParameters);
		}
		else
		{
			$this->render('list', $viewParameters);
		}
	}

	public function renderListLinks()
	{
		$webUser = Yii::app()->user;
		$links = array();
		if (!$webUser->isGuest && $webUser->checkAccess('Video.Create'))
		{
			$links['create'] = $this->createUrl('create');
		}

		if (empty($links))
		{
			return '';
		}
		else
		{
			return $this->renderPartial('list-links', array('links' => $links), true);
		}
	}

	public function actionCreate()
	{
		$model = new Video;

		if (isset($_POST['Video']))
		{
			$model->attributes = $_POST['Video'];
			if ($model->save())
			{
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionEdit($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Video']))
		{
			$model->attributes = $_POST['Video'];
			if ($model->save())
			{
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('edit', array(
			'model' => $model,
		));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		if (Yii::app()->request->isPostRequest)
		{
			if (isset($_POST['delete']))
			{
				$model->delete();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
			}
			else
			{
				$this->redirect(array('item', 'id' => $model->id));
			}
		}

		$this->render('delete', array(
			'model' => $model,
		));
	}

	/**
	 * @throws CHttpException
	 * @param  int $id
	 * @return Video
	 */
	public function loadModel($id)
	{
		$id = (int)$id;
		$this->_model = Video::model()->findByPk($id);
		if ($this->_model === null)
		{
			Yii::log("Video with id=$id is not found", 'error', 'application.controllers.VideoController');
			throw new CHttpException(404, 'Видеозапись не найдена.');
		}
		return $this->_model;
	}
}
