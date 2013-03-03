<?php
$breadcrumbs = $this->getBreadcrumbs();
$lastCrumb = $breadcrumbs[0];
unset($breadcrumbs[0]);
$breadcrumbs = array_merge($breadcrumbs, array(
	$lastCrumb => array('list', 'type' => $model->type),
	$shortTitle,
));
$this->setBreadcrumbs($breadcrumbs);
$this->pageTitle = $model->title . ' | ' . Yii::app()->name;
$this->renderDynamic('renderItemLinks', $model->type, $model->url);
?>
<header class="article-header">
	<?php if (!empty($model->published)): ?>
		<p class="published-info">
			Published:
			<?php echo CHtml::encode($model->published); ?>,
			<?php echo CHtml::encode($model->published_number); ?>
		</p>
	<?php endif; ?>
	<hgroup>
		<h2 class="article-author"><?php echo CHtml::encode($model->author); ?></h2>
		<h1 class="article-title"><?php echo CHtml::encode($model->title); ?></h1>
	</hgroup>
</header>
<?php
echo $model->text;
