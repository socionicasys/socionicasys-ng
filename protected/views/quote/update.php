<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'№ ' . $model->id => array('view', 'id' => $model->id),
	'Редактировать',
));
$this->pageTitle = 'Редактировать цитату | ' . Yii::app()->name;

echo $this->renderPartial('_form', array(
	'model' => $model
));
