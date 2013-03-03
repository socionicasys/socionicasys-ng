<?php
$cs = Yii::app()->clientScript;
$base = Yii::app()->request->baseUrl;
$cs->registerCssFile("$base/styles/html5reset.css");
$cs->registerCssFile("$base/styles/main.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo $base; ?>/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo $cs->appendTimestamp($base . '/scripts/html5shiv.js'); ?>"></script>
	<![endif]-->
</head>
<body>
<?php echo $content; ?></body>
</html>
