<hgroup>
	<?php if (!empty($model->category)) : ?>
	<h1><?php echo CHtml::encode($model->category); ?></h1>
	<?php endif; ?>
	<h2><?php echo CHtml::encode($model->title); ?></h2>
</hgroup>
<?php
$this->renderDynamic('renderItemLinks', $model->id);
$this->renderVideo($model->link);
echo $model->comment;
