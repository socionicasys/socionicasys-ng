<?php
Yii::import('ext.yiiext.widgets.ckeditor.ECKEditor');

class ECKEditorSetup extends ECKEditor
{
	public function init()
	{
		$this->editorTemplate = 'advanced';
		$this->toolbar = array(
			array(
				'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Styles', 'FontSize',
				'-',
				'TextColor', 'BGColor',
				'-',
				'Undo', 'Redo',
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
		$options = array(
			'toolbarCanCollapse' => false,
			'bodyId' => 'content',
			'bodyClass' => 'content-editor',
			'contentsCss' => Yii::app()->clientScript->appendTimestamp(
				Yii::app()->request->baseUrl . '/styles/main.css'
			),
			'coreStyles_underline' => array(
				'element' => 'span',
				'attributes' => array(
					'class' => 'underlined',
				),
			),
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
				array(
					'name' => 'Вырезка',
					'element' => 'div',
					'attributes' => array(
						'class' => 'aside',
					),
				),
				array(
					'name' => 'Термин',
					'element' => 'span',
					'attributes' => array(
						'class' => 'term',
					),
				),
				array(
					'name' => 'Цветной текст',
					'element' => 'span',
					'attributes' => array(
						'class' => 'colored',
					),
				),
			),
		);
		if (isset(Yii::app()->params['enableFileManager'])
			&& Yii::app()->params['enableFileManager'])
		{
			$options['filebrowserBrowseUrl'] = CHtml::normalizeUrl(array('site/browse'));
		}
		$this->options = $options;
		$this->htmlOptions = array(
			'rows' => 10,
			'cols' => 60,
		);
		parent::init(); 
	}
}
