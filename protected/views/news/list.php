<?php
$this->pageTitle='Новости | ' . Yii::app()->name;

$this->renderDynamic('renderListLinks');

$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_list-item',
	'emptyText' => 'Новостей нет.',
	'template' => "{items}\n{pager}",
));
