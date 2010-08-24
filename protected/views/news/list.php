<?php
$this->pageTitle='Новости | ' . Yii::app()->name;

if ($createUrlRoute !== null)
{
?>
<div class="news-operations">
	<a href="<?php echo $this->createUrl($createUrlRoute, $createUrlParams); ?>">
		Добавить новость
	</a>
</div>
<?php
}

$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_list-item',
	'emptyText' => 'Новостей нет.',
	'template' => "{items}\n{pager}",
	'viewData' => array(
		'articleLinks' => $articleLinks,
	),
));
