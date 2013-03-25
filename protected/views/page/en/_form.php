<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'page-form',
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'menu_title'); ?>
		<?php echo $form->textField($model,'menu_title',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'menu_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'meta_description'); ?>
		<?php echo $form->textArea($model, 'meta_description', array('rows' => 4, 'cols' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'meta_keywords'); ?>
		<?php echo $form->textArea($model, 'meta_keywords', array('rows' => 4, 'cols' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php
		$this->widget('ECKEditorSetup', array(
			'model' => $model,
			'attribute' => 'text',
		));
		?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
