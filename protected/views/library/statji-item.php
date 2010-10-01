<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	$model->title,
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
$this->renderItemLinks($model->type, $model->url);
echo $model->text;
