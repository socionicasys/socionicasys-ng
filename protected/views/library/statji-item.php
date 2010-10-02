<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	$model->title,
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
$this->renderItemLinks($model->type, $model->url);
?>
<header>
	<hgroup>
		<h1 class="article-author"><?php echo CHtml::encode($model->author); ?></h1>
		<h1 class="article-title"><?php echo CHtml::encode($model->title); ?></h1>
		<?php if (!empty($model->published)): ?>
			<p class="published-info">
				Опубликовано в:
				<?php echo CHtml::encode($model->published); ?>,
				<?php echo CHtml::encode($model->published_number); ?>
			</p>
		<?php endif; ?>
	</hgroup>
</header>
<?php
echo $model->text;
