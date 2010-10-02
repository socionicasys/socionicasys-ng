<?php
Yii::import('ext.yiiext.widgets.ckeditor.ECKEditor');

class ECKEditorSetup extends ECKEditor
{
	public function init()
	{
		$this->editorTemplate = 'advanced';
		$this->toolbar = array(
			array(
				'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Format',
				'-',
				'TextColor', 'BGColor',
				'-',
				'NumberedList', 'BulletedList', 'Blockquote',
				'-',
				'JustifyLeft', 'JustifyCenter', 'JustifyRight',
			),
			array(
				'Link', 'Unlink', 'Image',
				'-',
				'Maximize',
				'-',
				'Source',
			),
		);
		$this->options = array(
			'toolbarCanCollapse' => false,
		);
		$this->htmlOptions = array(
			'rows' => 10,
			'cols' => 60,
		);
		parent::init(); 
	}
}
