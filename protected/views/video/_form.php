<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'video-form',
	'enableAjaxValidation' => false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'link'); ?>
		<?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'link'); ?>
	</div>

	<div class="row">
		<?php
		$this->widget('ECKEditorSetup', array(
			'model' => $model,
			'attribute' => 'comment',
		));
		?>
		<?php echo $form->error($model, 'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>
<?php $this->endWidget(); ?>
