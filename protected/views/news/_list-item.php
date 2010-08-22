<article class="news-item" id="item-<?php echo CHtml::encode($data->id); ?>">
<?php $this->renderPartial('item', array('data' => $data)); ?>
</article>
