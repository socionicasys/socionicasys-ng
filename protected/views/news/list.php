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

$listView = $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_list-item',
	'emptyText' => 'Новостей нет.',
	'template' => "{items}\n{pager}",
	'viewData' => array(
		'links' => $links,
	),
	'afterAjaxUpdate' => "function(id, data) {
		$(document).scrollTop(0);
		id = $(data).find('.yiiPager .selected a').text();
		page = {};
		page['page'] = id;
		$.bbq.pushState( page );
	}",
));

Yii::app()->getClientScript()->registerCoreScript('bbq');
$id = $listView->id;
$url = $this->createAbsoluteUrl('') . '?News_page=';
Yii::app()->getClientScript()->registerScript('pagerHash',
	"$(window).bind( 'hashchange', function(e) {
		var pagenumber = $.bbq.getState( 'page' ) || '';
		var id = '$id';
		var url = '$url' + pagenumber;
		$.fn.yiiListView.update(id, {url: url});
	})", CClientScript::POS_READY);