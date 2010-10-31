<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'wide',
	),
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
		<?php echo $form->label($model,'published_number'); ?>
		<?php echo $form->textField($model,'published_number',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'published_number'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>
