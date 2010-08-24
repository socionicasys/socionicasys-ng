<header>
	<h1><?php echo CHtml::encode($data->title); ?></h1>
	<p><time class="published updated" pubdate="" datetime="<?php echo date('Y-m-d', $data->post_time); ?>"><?php echo date('d.m.Y', $data->post_time); ?></time></p>
</header> 
<?php echo $data->text; ?>
<?php if ($articleLinks !== null && !empty($articleLinks)): ?>
<div class="news-operations">
	<ul>
		<?php if ($articleLinks['edit'] !== null): ?>
		<li>
			<a href="<?php echo $this->createUrl($articleLinks['edit']['route'], $articleLinks['edit']['params']); ?>">
				Редактировать
			</a>
		</li>
		<?php endif; ?>
		<?php if ($articleLinks['delete'] !== null): ?>
		<li>
			<a href="<?php echo $this->createUrl($articleLinks['delete']['route'], $articleLinks['delete']['params']); ?>">
				Удалить
			</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
