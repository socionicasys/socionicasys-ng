<?php
$this->setBreadcrumbs(array(
    'Home' => Yii::app()->homeUrl,
    'Create new page'
));
$this->pageTitle = 'Create new page | ' . Yii::app()->name;
?>

<?php echo $this->renderPartial('_form', array(
    'model' => $model
)); ?>
