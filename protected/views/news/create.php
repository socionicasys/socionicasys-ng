<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list'),
	'Добавить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Добавить новость | ' . Yii::app()->name;
?>

<?php echo $this->renderPartial('_form', array(
	'model' => $model
)); ?>
