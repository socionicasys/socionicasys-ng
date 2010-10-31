<?php
$this->pageTitle='Статьи | ' . Yii::app()->name;

$this->renderListLinks($type);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'template' => '{items}',
	'columns' => array(
		'author',
		array(
			'name' => 'title',
			'type' => 'raw',
			'value' => 'CHtml::link($data->title, array(
				"view",
				"type" => $data->type,
				"title" => $data->url,
			))',
		),
		'published',
		'published_number',
	),
));
