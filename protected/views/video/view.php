<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list'),
	$model->title,
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Видеозапись | ' . Yii::app()->name;

$this->renderPartial('_item', array(
	'model' => $model,
));
