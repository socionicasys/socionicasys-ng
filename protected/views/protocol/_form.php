<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'protocol-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name' ,array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'tim'); ?>
		<?php echo $form->textField($model, 'tim', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'tim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'date'); ?>
		<?php echo $form->textField($model, 'date', array('size' => 60,'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'url'); ?>
		<?php echo $form->textField($model, 'url', array('size' => 60,'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
