<?php

class ProtocolController extends Controller
{
	public $layout = '//layouts/section-wide';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights - index',
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Protocol', array(
			'sort' => array(
				'defaultOrder' => 'date DESC',
			),
			'pagination' => false,
		));

		$webUser = Yii::app()->user;
		$canCreate = (!$webUser->isGuest && $webUser->checkAccess('Protocol.Create'));
		$canEdit = (!$webUser->isGuest && $webUser->checkAccess('Protocol.Edit'));
		$canDelete = (!$webUser->isGuest && $webUser->checkAccess('Protocol.Delete'));

		$this->render('list', array(
			'dataProvider' => $dataProvider,
			'canCreate' => $canCreate,
			'canEdit' => $canEdit,
			'canDelete' => $canDelete,
		));
	}
	
	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$model = new Protocol;

		if (isset($_POST['Protocol']))
		{
			$model->attributes = $_POST['Protocol'];
			if ($model->save())
			{
				$this->redirect(array('index'));
			}
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Protocol']))
		{
			$model->attributes = $_POST['Protocol'];
			if ($model->save())
			{
				$this->redirect(array('index'));
			}
		}

		$this->render('edit', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		if (Yii::app()->request->isPostRequest)
		{
			$ajaxRequest = Yii::app()->request->isAjaxRequest;
			if (isset($_POST['delete']) || $ajaxRequest)
			{
				$model->delete();
			}

			if (!$ajaxRequest)
			{
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}

		$this->render('delete', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Protocol::model()->findByPk((int)$id);
		if ($model === null)
		{
			throw new CHttpException(404);
		}
		return $model;
	}
}
