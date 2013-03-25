<?php
$this->widget('ext.EJNestedTreeActions.EJsTreeEx', array(
	'buttons' => array(
		'create' => array(
			'label' => 'Create new page',
			'options' => array(
				'class' => 'btn add',
				'onclick' => 'var t = $.tree.focused(); if(t.selected) t.create(); else alert("Select a node first");'
			),
		),
		'rename' => array(
			'label' => 'Rename',
			'options' => array(
				'class' => 'btn edit',
				'onclick' => '$.tree.focused().rename();',
			),
		),
		'delete' => array(
			'label' => 'Delete',
			'options' => array(
				'class' => 'btn delete',
				'onclick' => '$.tree.focused().remove();',
			),
		),
	),
));
