<h1>Цитаты</h1>

<p><a href="<?php echo $this->createUrl('create'); ?>">Добавить цитату</a></p>

<?php
$this->pageTitle='Цитаты | ' . Yii::app()->name;
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'template' => '{items}',
	'columns' => array(
		'author',
		'note',
		'text',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
