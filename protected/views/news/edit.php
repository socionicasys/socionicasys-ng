<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	$model->title => array('item', 'id' => $model->id),
	'Редактировать',
);
?>

<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
