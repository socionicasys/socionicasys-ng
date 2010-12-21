<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('index'),
	'Добавить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Добавить новый протокол | ' . Yii::app()->name;

echo $this->renderPartial('_form', array(
	'model' => $model,
));
