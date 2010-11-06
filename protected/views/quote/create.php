<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'Добавить новую',
));

echo $this->renderPartial('_form', array(
	'model' => $model
));
