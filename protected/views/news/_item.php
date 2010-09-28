<header>
	<h1><?php echo CHtml::encode($data->title); ?></h1>
	<p><time class="published updated" pubdate="" datetime="<?php echo date('Y-m-d', $data->post_time); ?>"><?php echo date('d.m.Y', $data->post_time); ?></time></p>
</header> 
<?php echo $data->text; ?>
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
