<?php
if (isset($links['manage']))
{
	$this->beginClip('sidebar');
?>
	<div id="manage-pages">
		<a href="<?php echo $links['manage']; ?>">Управление страницами</a>
	</div>
<?php
	$this->endClip();
}
?>
<?php if ($pageControls): ?>
<div id="page-controls">
	<ul>
		<?php if (isset($links['create'])): ?>
		<li>
			<a href="<?php echo $links['create']; ?>">Создать</a>
		</li>
		<?php endif; ?>
		<?php if (isset($links['edit'])): ?>
		<li>
			<a href="<?php echo $links['edit']; ?>">Редактировать</a>
		</li>
		<?php endif; ?>
		<?php if (isset($links['delete'])): ?>
		<li>
			<a href="<?php echo $links['delete']; ?>">Удалить</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
<?php echo $text; ?>
