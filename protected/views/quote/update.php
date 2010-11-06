<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'№ ' . $model->id => array('view', 'id' => $model->id),
	'Редактировать',
));

echo $this->renderPartial('_form', array(
	'model' => $model
));
