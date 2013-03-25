<?php
$cs = Yii::app()->clientScript;
$base = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="alternate" type="application/atom+xml" href="<?php echo $this->createUrl('news/feed'); ?>" />
	<link rel="stylesheet" type="text/css" title="Trebuchet" href="<?php echo $cs->appendTimestamp($base . '/styles/main.css'); ?>" media="all" />
	<link rel="stylesheet" type="text/css" title="Trebuchet" href="<?php echo $cs->appendTimestamp($base . '/styles/main.en.css'); ?>" media="all" />
	<link rel="shortcut icon" href="<?php echo $base; ?>/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php echo $base; ?>/apple-touch-icon.png" />
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
            <?php $this->renderDynamic('renderHeaderLinks'); ?>
			<a id="logo-link" href="<?php echo Yii::app()->homeUrl; ?>">
				<h1>School of System Socionics</h1>
				<h2>“Practice is the proof of the truth”</h2>
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
		<p>&copy; School of System Socionics, <?php echo $this->years; ?>.</p>
	</footer>
<?php $this->widget('GoogleAnalytics'); ?>
<?php $this->widget('YandexMetrika'); ?>
</body>
</html>
