<?php
$this->widget('ext.EJNestedTreeActions.EJsTreeEx', array(
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
		'create_root' => array(
			'type' => 'ajax',
			'label' => 'Create root',
			'ajaxurl' => '',
			'ajaxoptions' => array(
				'global'=>false,
				'type' => "POST",
				'async'=> false,
				'success'=>'js:function(bool) {
					if (bool) {
						$.tree.focused().refresh();
					} else {
						alert("You can not create root");
					}
				}'
			),		
			'options' => array(
				'class' => 'btn add',				
			),			
		),
	),
));
