<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	'Добавить',
);
$this->pageTitle = 'Добавить новость | ' . Yii::app()->name;
?>

<?php echo $this->renderPartial('_form', array(
	'model' => $model
)); ?>
