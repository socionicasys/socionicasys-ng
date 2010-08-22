<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	'Добавить',
);
$this->pageTitle = 'Добавить новость | ' . Yii::app()->name;
?>

<h1>Добавить новость</h1>

<?php echo $this->renderPartial('_form', array(
	'model' => $model
)); ?>
