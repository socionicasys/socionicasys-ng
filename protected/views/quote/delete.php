<?php
$this->setBreadcrumbs(array(
	'Цитаты' => array('index'),
	'№ ' . $model->id => array('view', 'id' => $model->id),
	'Редактировать',
));
$this->pageTitle = 'Удалить цитату | ' . Yii::app()->name;

echo CHtml::beginForm(); ?>
	<p>Вы действительно хотите удалить цитату?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Отменить" />
		<input type="submit" name="delete" value="Удалить" />
	</div>
<?php echo CHtml::endForm();
