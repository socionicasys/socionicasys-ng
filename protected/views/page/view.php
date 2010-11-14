<?php
$this->renderDynamic('renderPageLinks', $model->id, $model->url);
echo $model->text;
if (!$standalone): ?>
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
