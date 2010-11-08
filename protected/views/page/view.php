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
<?php if (!$standalone): ?>
<nav id="nav-controls">
	<ul>
		<?php if ($prevLink !== null): ?>
		<li id="prev-link"><a href="<?php echo $prevLink; ?>">« Предыдущая страница</a></li>
		<?php endif; ?>
		<?php if ($nextLink !== null): ?>
		<li id="next-link"><a href="<?php echo $nextLink; ?>">Следующая страница »</a></li>
		<?php endif; ?>
	</ul>
</nav>
<?php endif;
