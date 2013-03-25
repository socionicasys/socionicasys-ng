<?php
$this->setBreadcrumbs(null);
$this->pageTitle = 'Login | ' . Yii::app()->name;
?>
<h1>Login</h1>
<p>Enter your forum username and password to login</p>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => true,
	'htmlOptions' => array(
		'class' => 'wide',
	),
));
?>
	<?php echo CHtml::hiddenField('backUrl', $backUrl); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model, 'rememberMe'); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
		<?php echo $form->error($model, 'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
<?php $this->endWidget(); ?>
