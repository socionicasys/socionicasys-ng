<?php $this->beginContent('//layouts/common'); ?>
<div id="content-wrap" class="wide">
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
	<div class="hyphenate">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent();
