<article class="video-record" id="video-<?php echo CHtml::encode($data->id); ?>">
<?php
$this->renderPartial('_item', array(
	'model' => $data,
));
?>
</article>
