<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
);
$this->beginWidget('CMarkdown', array('purifyOutput' => true));
?>
# Структура сайта

* [Главная](/index)
	* [История соционики](/istorija-socioniki)
	* [О Школе системной соционики](/o-shkole)
	* [Новости](/novosti)
	* [Контакты](/kontaky)
* [Теория](/teorija)
	* [Соционика для начинающих](/teorija/socionika-dlja-nachinajushhih)
	* [Вступление к системной соционике](/teorija/vstuplenije)
	* [Системный подход](/teorija/sistemnyj-podhod)
* [Практика определения ТИМа](/praktika)
* [Статьи, доклады](/statji-doklady)
* [Форум](/forum)
<?php
$this->endWidget();
