<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	'Добавить',
);
?>

<h1>Добавить новость</h1>

<?php echo $this->renderPartial('_form', array(
	'model' => $model
)); ?>
