<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'published'); ?>
		<?php echo $form->textField($model,'published',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text'); ?>
		<?php
		$this->widget('ext.yiiext.widgets.ckeditor.ECKEditor', array(
			'model' => $model,
			'attribute' => 'text',
			'editorTemplate' => 'advanced',
			'toolbar' => array(
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
			),
			'options' => array(
				'toolbarCanCollapse' => false,
			),
			'htmlOptions' => array(
				'rows' => 10,
				'cols' => 60,
			),
		));
		?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>
