<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => $model->url,
	'Редактировать',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Редактировать страницу | ' . Yii::app()->name;
?>

<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
