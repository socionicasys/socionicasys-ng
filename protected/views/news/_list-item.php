<article class="news-item" id="item-<?php echo CHtml::encode($data->id); ?>">
<?php
$this->renderPartial('_item', array(
	'data' => $data,
));
?>
</article>
