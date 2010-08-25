<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	$model->title,
);

$this->renderPartial('_item', array(
	'data' => $model,
	'articleLinks' => $articleLinks,
)); ?>
