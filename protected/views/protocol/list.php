<h1>Протоколы идентификации ТИМа</h1>

<p>Протоколы, созданные после июля 2010 года, были сгенерированны в программе
<a href="/praktika/programma-informacionnyj-analiz">Информационный анализ</a>.

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
	'id' => 'protocol-table',
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'template' => '{items}',
	'columns' => array(
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->name) . (empty($data->comment) ? "" :
				CHtml::link("*", "", array("title" => $data->comment)))',
		),
		'tim',
		'date',
		array(
			'name' => 'ia',
			'value' => '$data->ia ? "Да" : "Нет"',
			'header' => 'ИА',
			'headerHtmlOptions' => array(
				'title' => 'Сохранен ли протокол в формате ИА (программа «Информационный анализ»)'
			),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => $buttonTemplate,
			'viewButtonUrl' => '$data->url',
			'viewButtonLabel' => 'Скачать',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("edit", array("id" => $data->id))',
		),
	),
));
