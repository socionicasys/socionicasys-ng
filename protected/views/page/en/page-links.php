<div id="page-controls">
	<ul>
		<?php if (isset($links['create'])): ?>
		<li>
			<a href="<?php echo $links['create']; ?>">Create</a>
		</li>
		<?php endif; ?>
		<?php if (isset($links['edit'])): ?>
		<li>
			<a href="<?php echo $links['edit']; ?>">Edit</a>
		</li>
		<?php endif; ?>
		<?php if (isset($links['delete'])): ?>
		<li>
			<a href="<?php echo $links['delete']; ?>">Delete</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
