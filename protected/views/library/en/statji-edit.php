<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	$model->title => array('view', 'type' => $model->type, 'title' => $model->url),
	'Edit',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Edit article | ' . Yii::app()->name;

$this->renderPartial($model->type . '-form', array(
	'model' => $model
));
