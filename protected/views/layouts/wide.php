<?php $this->beginContent('//layouts/common'); ?>
<div id="content-wrap" <?php echo $this->layoutAttr; ?>>
	<?php
	$breadcrumbs = $this->getBreadcrumbs();
	if (count($breadcrumbs) > 1):
	?>
	<nav id="breadcrumbs">
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $breadcrumbs,
			'homeLink' => false,
		)); ?>
	</nav>
	<?php endif; ?>
	<div id="content" class="hyphenate">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent();
