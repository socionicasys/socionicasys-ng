<h1>Протоколы идентификации ТИМа</h1>

<p>Протоколы, созданные после июля 2010 года, были сгенерированны в программе
<a href="/praktika/programma-informacionnyj-analiz">Информационный анализ</a> (ИА).
Протоколы, созданные раньше, доступны в формате MS Word, а также переведены в формат ИА.</p>

<?php if ($canCreate) : ?>
<p><a href="<?php echo $this->createUrl('create'); ?>">Добавить протокол</a></p>
<?php endif; ?>

<?php
$this->pageTitle='Протоколы | ' . Yii::app()->name;

$buttonTemplate = '';
if ($canEdit)
{
	$buttonTemplate .= ' {update}';
}
if ($canDelete)
{
	$buttonTemplate .= ' {delete}';
}
$columns = array(
	array(
		'name' => 'name',
		'type' => 'raw',
		'value' => 'CHtml::encode($data->name) . (empty($data->comment) ? "" :
			CHtml::link("*", "", array("title" => $data->comment)))',
	),
	'tim',
	'date',
	array(
		'class' => 'CButtonColumn',
		'template' => '{view}',
		'buttons' => array(
			'view' => array(
				'label' => 'Просмотреть',
				'url' => '$data->url',
				'visible' => '!empty($data->url)',
			),
		),
		'header' => 'ИА',
		'headerHtmlOptions' => array(
			'title' => 'Ссылки на протокол в формате ИА (программа «Информационный анализ»)',
		),
	),
	array(
		'class' => 'CButtonColumn',
		'template' => '{view}',
		'buttons' => array(
			'view' => array(
				'label' => 'Скачать',
				'url' => '$data->legacy_url',
				'visible' => '!empty($data->legacy_url)',
			),
		),
		'header' => 'Word',
		'headerHtmlOptions' => array(
			'title' => 'Ссылки на протокол в формате Microsoft Word',
		),
	),
);
if ($buttonTemplate !== '')
{
	$columns[] = array(
		'class' => 'CButtonColumn',
		'template' => $buttonTemplate,
		'updateButtonUrl' => 'Yii::app()->controller->createUrl("edit", array("id" => $data->id))',
	);
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'protocol-table',
	'dataProvider' => $dataProvider,
	'enablePagination' => false,
	'template' => '{items}',
	'columns' => $columns,
));
