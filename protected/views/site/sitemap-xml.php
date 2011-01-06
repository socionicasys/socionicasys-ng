<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
		http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach ($news as $model): ?>
	<url>
		<loc><?php echo CHtml::encode($model->getUrl(true)); ?></loc>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
<?php endforeach; ?>

<?php foreach ($pages as $model): ?>
	<url>
		<loc><?php echo CHtml::encode($model->getUrl(true)); ?></loc>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
<?php endforeach; ?>

<?php foreach ($articles as $model): ?>
	<url>
		<loc><?php echo CHtml::encode($model->getUrl(true)); ?></loc>
		<changefreq>monthly</changefreq>
		<priority>0.6</priority>
	</url>
<?php endforeach; ?>

<?php foreach ($videos as $model): ?>
	<url>
		<loc><?php echo CHtml::encode($model->getUrl(true)); ?></loc>
		<changefreq>monthly</changefreq>
		<priority>0.5</priority>
	</url>
<?php endforeach; ?>
</urlset>
