<?php
$this->breadcrumbs=array(
	'Quotes',
);

$this->menu=array(
	array('label'=>'Create Quote', 'url'=>array('create')),
	array('label'=>'Manage Quote', 'url'=>array('admin')),
);
?>

<h1>Quotes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
