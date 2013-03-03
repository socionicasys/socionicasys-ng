<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	'Create',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Create an article | ' . Yii::app()->name;

$this->renderPartial($model->type . '-form', array(
	'model' => $model
));
