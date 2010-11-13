<?php
$cs = Yii::app()->clientScript;
$base = Yii::app()->request->baseUrl;
$cs->registerCssFile("$base/styles/html5reset.css");
$cs->registerCssFile("$base/styles/font-face.css");
$cs->registerCssFile("$base/styles/main.css");
$cs->registerLinkTag(
	'alternate',
	'application/atom+xml',
	$this->createUrl('news/feed')
);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo $base; ?>/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo $cs->appendTimestamp($base . '/scripts/html5shiv.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $cs->appendTimestamp($base . '/styles/ie.css'); ?>">
	<![endif]-->
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo $cs->appendTimestamp($base . '/styles/ie6.css'); ?>" media="all">
	<![endif]-->
</head>
<body id="body">
	<div id="wrap">
		<header id="main-header">
			<?php foreach ($this->headerlinks as $label => $url): ?>
				<a class="header-link" href="<?php echo $url; ?>"><?php echo $label; ?></a>
			<?php endforeach; ?>
			<a href="<?php echo Yii::app()->homeUrl; ?>">
				<img src="/images/Logo.png?2" alt="Школа системной соционики" />
			</a>
		</header>
		<nav id="major-navigation">
			<?php $this->widget('zii.widgets.CMenu', array(
				'items' => $this->majorMenu,
				'activateItems' => false,
			)); ?>
		</nav>
		<div id="content-area" <?php echo $this->layoutAttr; ?>>
			<?php echo $content; ?>
		</div>
	</div>
	<footer id="main-footer">
		<p>&copy; Школа системной соционики, <?php echo $this->years; ?>.</p>
	</footer>
<?php $this->widget('GoogleAnalytics'); ?>
<?php $this->widget('YandexMetrika'); ?>
</body>
</html>
