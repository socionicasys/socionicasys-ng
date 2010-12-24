<h1>Контакты Школы системной соционики</h1>

<p>
	Если у вас есть вопросы или предложения, вы можете поделиться ими по адресу
	<a href="mailto:<?php echo $adminEmail; ?>"><?php echo $adminEmail; ?></a>, или заполнив форму:
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<p>
	Кроме данного сайта, контакт со Школой системной соционики можно установить так же на семинарах в Киевском городском
	доме учителя (ул.&nbsp;Владимирская&nbsp;57), которые проходят один раз в месяц с сентября по июнь по вторым
	понедельникам каждого месяца с 18:30 до 20:30.
</p>
