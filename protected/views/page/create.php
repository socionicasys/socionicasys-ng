<?php
$this->setBreadcrumbs(array(
	'Главная' => Yii::app()->homeUrl,
	'Добавить страницу'
));
$this->pageTitle = 'Добавить страницу | ' . Yii::app()->name;
?>

<?php echo $this->renderPartial('_form', array(
	'model' => $model
)); ?>
