<?php

class NewsController extends Controller
{
	public $layout = '//layouts/section';
	
	public function actionList()
	{
		$dataProvider = new CActiveDataProvider('News', array(
			'criteria' => array(
				'order' => 'post_time DESC',
			),
			'pagination' => array(
				'pageSize' => 10,
			),
		));
		
		$this->render('list', array(
			'dataProvider' => $dataProvider,
		));
	}
}
