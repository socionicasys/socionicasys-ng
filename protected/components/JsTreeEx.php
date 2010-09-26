<?php
Yii::import('ext.EJNestedTreeActions.EJsTreeEx');

class JsTreeEx extends EJsTreeEx
{
	public function init()
	{
		parent::init();
		if (!isset($this->buttons['create_root']['label']))
		{
			unset($this->buttons['create_root']);
		}
	}
}
