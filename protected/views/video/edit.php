<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list'),
	$model->title => array('item', 'id' => $model->id),
	'Редактировать',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Редактировать видеозапись | ' . Yii::app()->name;

$this->renderPartial('_form', array(
	'model' => $model
));
