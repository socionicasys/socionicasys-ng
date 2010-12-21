<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('index'),
	'Протокол ' . $model->name,
	'Удалить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Удалить протокол | ' . Yii::app()->name;

echo CHtml::beginForm(); ?>
	<p>Вы действительно хотите удалить протокол?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Отменить" />
		<input type="submit" name="delete" value="Удалить" />
	</div>
<?php echo CHtml::endForm();
