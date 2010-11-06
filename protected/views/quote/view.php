<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'№ ' . $model->id,
));

$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'author',
		'note',
		'text',
	),
));
