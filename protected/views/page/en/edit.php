<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => $model->url,
	'Edit',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Edit page | ' . Yii::app()->name;
?>

<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
