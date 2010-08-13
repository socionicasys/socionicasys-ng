<?php
$this->pageTitle='Новости | ' . Yii::app()->name;
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => 'view',
	'emptyText' => 'Новостей нет.',
	'template' => '{items}\n{pager}',
));
