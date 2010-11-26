<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list'),
	$model->title => array('item', 'id' => $model->id),
	'Удалить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Удалить видеозапись | ' . Yii::app()->name;

echo CHtml::beginForm(); ?>
	<p>Вы действительно желаете удалить видеозапись?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Отменить" />
		<input type="submit" name="delete" value="Удалить" />
	</div>
<?php echo CHtml::endForm();
