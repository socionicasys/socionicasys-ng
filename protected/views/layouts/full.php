<?php $this->beginContent('//layouts/common'); ?>
<div id="content-wrap">
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
<aside id="secondary-navigation">
	<nav>
		<?php
			$this->widget('zii.widgets.CMenu', array(
				'items' => $this->minorMenu,
				'activateItems' => false,
			));
		?>
	</nav>
	<?php $this->renderDynamic('renderSidebarLinks'); ?>
</aside>
<aside id="random-quote">
	<?php $this->renderDynamic('renderRandomQuote'); ?>
</aside>
<?php $this->endContent();
