<?php
$this->widget('JsTreeEx', array(
	'buttons' => array(
		'create' => array(
			'label' => 'Создать страницу',
			'options' => array(
				'class' => 'btn add',
				'onclick' => 'var t = $.tree.focused(); if(t.selected) t.create(); else alert("Select a node first");'
			),
		),
		'rename' => array(
			'label' => 'Переименовать',
			'options' => array(
				'class' => 'btn edit',
				'onclick' => '$.tree.focused().rename();',
			),
		),
		'delete' => array(
			'label' => 'Удалить',
			'options' => array(
				'class' => 'btn delete',
				'onclick' => '$.tree.focused().remove();',
			),
		),
	),
));
