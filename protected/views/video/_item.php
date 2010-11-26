<h1><?php echo CHtml::encode($model->title); ?></h1>
<?php
$this->renderDynamic('renderItemLinks', $model->id);
$this->renderVideo($model->link);
echo $model->comment;
