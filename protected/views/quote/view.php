<?php
$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Quote', 'url'=>array('index')),
	array('label'=>'Create Quote', 'url'=>array('create')),
	array('label'=>'Update Quote', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Quote', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Quote', 'url'=>array('admin')),
);
?>

<h1>View Quote #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'author',
		'note',
		'text',
	),
)); ?>
