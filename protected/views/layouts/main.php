<?php
	$cs = Yii::app()->clientScript;
	$base = Yii::app()->request->baseUrl;
	$cs->registerCssFile("$base/styles/html5reset.css?201003011726");
	$cs->registerCssFile("$base/styles/font-face.css?201008081309");
	$cs->registerCssFile("$base/styles/main.css?201008170953");
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
	<script src="<?php echo $base; ?>/scripts/html5shiv.js?201006131732" type="text/javascript"></script>
	<script src="<?php echo $base; ?>/scripts/ie9.js?201004302159" type="text/javascript"></script>
	<![endif]-->
</head>
<body>
	<header id="main-header">
		<hgroup>
			<h1><a href="<?php echo Yii::app()->homeUrl; ?>">Школа системной соционики</a></h1>
			<h2>Практика — критерий истины</h2>
		</hgroup>
	</header>
	<nav id="major-navigation">
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => $this->majorMenu,
			'activateItems' => false,
		)); ?>
	</nav>
	<div id="content-area">
		<div id="content-wrap">
			<?php if (!empty($this->breadcrumbs)): ?>
				<nav id="breadcrumbs">
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?>
				</nav>
			<?php endif; ?>
			<div>
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
		</aside>
	</div>
</body>
</html>
