<?php $this->pageTitle='Contacts | ' . Yii::app()->name; ?>
<h1>Contacting us</h1>

<p>
	You could share any your ideas or suggestions with us via email
	<a href="mailto:<?php echo $adminEmail; ?>"><?php echo $adminEmail; ?></a> or with the help of the form below:
</p>

<?php if (Yii::app()->user->hasFlash('contact')) : ?>
<p class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</p>
<?php endif; ?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model, 'name'); ?>
		<?php echo $form->textField($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'body'); ?>
		<?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'verificationCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model, 'verificationCode'); ?>
		</div>
		<div class="hint">Please enter verification code from the picture</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<!--<p>
	Кроме данного сайта, контакт со Школой системной соционики можно установить так же на семинарах в Киевском городском
	доме учителя (ул.&nbsp;Владимирская&nbsp;57), которые проходят один раз в месяц с сентября по июнь по вторым
	понедельникам каждого месяца с 18:30 до 20:30.
</p>
-->