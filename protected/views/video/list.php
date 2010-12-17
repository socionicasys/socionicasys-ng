<?php
$this->pageTitle='Видеозаписи | ' . Yii::app()->name;

$this->renderDynamic('renderListLinks');

$listView = $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'emptyText' => 'Видеозаписей нет.',
	'template' => '{items}',
	'columns' => array(
		'title',
		'category',
		'date',
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}',
		),
	),
));
