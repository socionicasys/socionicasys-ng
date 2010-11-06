<?php
$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Quote', 'url'=>array('index')),
	array('label'=>'Manage Quote', 'url'=>array('admin')),
);
?>

<h1>Create Quote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>