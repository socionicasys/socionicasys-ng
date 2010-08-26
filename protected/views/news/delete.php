<?php
$this->breadcrumbs = array(
	'Новости' => array('list'),
	$model->title => array('item', 'id' => $model->id),
	'Удалить',
);
?>

<form method="post">
	<p>Вы действительно желаете удалить новостную статью?</p>
	<div class="row buttons">
		<input type="submit" name="cancel" value="Отменить" />
		<input type="submit" name="delete" value="Удалить" />
	</div>
</form>
