<?php if (!empty($links)): ?>
<div class="news-operations child">
	<ul>
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
