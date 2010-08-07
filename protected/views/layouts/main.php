<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<?php
		$cs = Yii::app()->clientScript;
		$base = Yii::app()->request->baseUrl;
		$cs->registerCssFile("$base/style/html5resel.css");
		$cs->registerCssFile("$base/style/main.css");
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo $base; ?>/script/html5shiv.js" type="text/javascript"></script>
	<script src="<?php echo $base; ?>/script/ie9.js" type="text/javascript"></script>
	<![endif]-->
</head>
<body>
	<header id="main-header">
		<hgroup>
			<h1>Школа системной соционики</h1>
			<h2>Практика — критерий истины</h2>
		</hgroup>
	</header>
	<nav id="major-navigation">
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => $this->majorMenu,
			'activateItems' => false,
		)); ?>
	</nav>
	<nav id="breadcrumbs">
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	</nav>
	<div id="content-area">
		<?php echo $content; ?>
		<nav id="secondary-navigation">
			<?php
				$this->widget('zii.widgets.CMenu', array(
					'items' => $this->minorMenu,
				));
			?>
		</nav>
	</div>
	<footer id="main-footer">
		<?php echo Yii::powered(); ?>
	</footer>
</body>
</html>
