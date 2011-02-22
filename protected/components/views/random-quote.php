<!--noindex-->
<section class="random-quote">
	<h1>Мысли человечества в аспектах</h1>
	<blockquote class="hyphenate">
		<?php echo $quote->text; ?>
	</blockquote>
<?php if (!empty($quote->author)): ?>
	<p class="random-quote-author"><?php echo $quote->author; ?></p>
<?php endif; ?>
<?php if (!empty($quote->note)): ?>
	<p class="random-quote-note">(<?php echo $quote->note; ?>)</p>
<?php endif; ?>
</section>
<!--/noindex-->
