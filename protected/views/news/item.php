<header>
	<h1><?php echo CHtml::encode($data->title); ?></h1>
	<p><time class="published updated" pubdate="" datetime="<?php echo date('Y-m-d', $data->post_time); ?>"><?php echo date('d.m.Y', $data->post_time); ?></time></p>
</header> 
<?php echo $data->text; ?>
