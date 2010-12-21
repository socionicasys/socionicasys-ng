<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('index'),
	'Протокол ' . $model->name,
	'Редактировать',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Редактировать протокол | ' . Yii::app()->name;

echo $this->renderPartial('_form', array(
	'model' => $model,
));
