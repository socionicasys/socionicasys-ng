<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'Добавить новую',
));
$this->pageTitle = 'Добавить новую цитату | ' . Yii::app()->name;

echo $this->renderPartial('_form', array(
	'model' => $model
));
