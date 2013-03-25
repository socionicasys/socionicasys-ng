<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => $model->url,
	'Удалить',
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = 'Delete page | ' . Yii::app()->name;
?>

<?php echo CHtml::beginForm(); ?>
	<p>Are you sure you want to delete this page?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Cancel" />
		<input type="submit" name="delete" value="Delete" />
	</div>
<?php echo CHtml::endForm();
