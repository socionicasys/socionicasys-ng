<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	$model->title => array('item', 'id' => $model->id),
	'Редактировать',
);
?>

<h1>Редактировать новость №<?php echo $model->id; ?></h1>

<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
