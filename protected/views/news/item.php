<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list'),
	$shortTitle,
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Новости | ' . Yii::app()->name;

$this->renderPartial('_item', array(
	'data' => $model,
)); ?>
