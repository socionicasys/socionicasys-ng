<?php
$this->pageTitle='Видеозаписи | ' . Yii::app()->name;

$this->renderDynamic('renderListLinks');

$listView = $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_list-item',
	'emptyText' => 'Видеозаписей нет.',
	'template' => "{items}\n{pager}",
));
