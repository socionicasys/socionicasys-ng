<?php
Yii::import('ext.yiiext.widgets.ckeditor.ECKEditor');

class ECKEditorSetup extends ECKEditor
{
	public function init()
	{
		$this->editorTemplate = 'advanced';
		$this->toolbar = array(
			array(
				'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Styles',
				'-',
				'TextColor', 'BGColor',
				'-',
				'NumberedList', 'BulletedList', 'Blockquote', 'Outdent','Indent',
				'-',
				'JustifyLeft', 'JustifyCenter', 'JustifyRight',
			),
			array(
				'PasteFromWord', 'Link', 'Unlink', 'Image', 'Table', 'HorizontalRule',
				'-',
				'Maximize', 'Source',
			),
		);
		$this->options = array(
			'toolbarCanCollapse' => false,
			'stylesSet' => array(
				array(
					'name' =>  'Заголовок 1',
					'element' => 'h1',
				),
				array(
					'name' =>  'Заголовок 2',
					'element' => 'h2',
				),
				array(
					'name' =>  'Заголовок 3',
					'element' => 'h3',
				),
				array(
					'name' =>  'Заголовок 4',
					'element' => 'h4',
				),
				array(
					'name' => 'Автор (цитаты)',
					'element' => 'p',
					'attributes' => array(
						'class' => 'quote-author',
					),
				),
				array(
					'name' => 'Аннотация',
					'element' => 'p',
					'attributes' => array(
						'class' => 'article-abstract',
					),
				),
				array(
					'name' => 'Эпиграф',
					'element' => 'blockquote',
					'attributes' => array(
						'class' => 'epigraph',
					),
				),
				array(
					'name' => 'Определение',
					'element' => 'p',
					'attributes' => array(
						'class' => 'definition',
					),
				),
				array(
					'name' =>  'Обычный текст',
					'element' => 'p',
				),
			),
		);
		$this->htmlOptions = array(
			'rows' => 10,
			'cols' => 60,
		);
		parent::init(); 
	}
}
