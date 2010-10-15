<?php
$this->pageTitle='Новости | ' . Yii::app()->name;

if (isset($links['create']))
{
?>
<div class="news-operations">
	<a href="<?php echo $links['create']; ?>">Добавить новость</a>
</div>
<?php
}

$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_list-item',
	'emptyText' => 'Новостей нет.',
	'template' => "{items}\n{pager}",
	'viewData' => array(
		'links' => $links,
	),
	'afterAjaxUpdate' => "function(id, data) {
		$(document).scrollTop(0);
	}",
));
