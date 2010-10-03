<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	$model->title => array('view', 'type' => $model->type, 'title' => $model->url),
	'Удалить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Удалить статью | ' . Yii::app()->name;
?>

<?php echo CHtml::beginForm(); ?>
	<p>Вы действительно желаете удалить статью?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Отменить" />
		<input type="submit" name="delete" value="Удалить" />
	</div>
<?php echo CHtml::endForm();
