<h1>Протоколы идентификации ТИМа</h1>

<?php if ($canCreate) : ?>
<p><a href="<?php echo $this->createUrl('create'); ?>">Добавить протокол</a></p>
<?php endif; ?>

<?php
$this->pageTitle='Протоколы | ' . Yii::app()->name;

$buttonTemplate = '{view}';
if ($canEdit)
{
	$buttonTemplate .= ' {update}';
}
if ($canDelete)
{
	$buttonTemplate .= ' {delete}';
}
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'template' => '{items}',
	'columns' => array(
		'name',
		'tim',
		'date',
		array(
			'class' => 'CButtonColumn',
			'template' => $buttonTemplate,
			'viewButtonUrl' => '$data->url',
			'viewButtonLabel' => 'Скачать',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("edit", array("id" => $data->id))',
		),
	),
));
