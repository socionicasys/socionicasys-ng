<?php

class NewsController extends Controller
{
	public $layout = '//layouts/section';
	
	public function actionList()
	{
		$dataProvider = new CActiveDataProvider('News', array(
			'criteria' => array(
				'order' => 'post_time DESC',
			),
			'pagination' => array(
				'pageSize' => 10,
			),
		));
		
		if (Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial('list', array(
				'dataProvider' => $dataProvider,
			));
		}
		else
		{
			$this->render('list', array(
				'dataProvider' => $dataProvider,
			));
		}
	}
	
	public function actionFeed()
	{
		Yii::import('application.vendors.*');
		require_once('Zend/Loader/Autoloader.php');
		Yii::registerAutoloader(array('Zend_Loader_Autoloader', 'autoload'));
		
		$latestNews = News::model()->findAll(array(
			'order' => 'post_time DESC',
			'limit' => 10,
		));
		
		$feedEntries = array();
		$lastUpdateTime = null; 
		foreach ($latestNews as $newsItem)
		{
			$entryUrl = CHtml::encode($this->createAbsoluteUrl('news/list', array(
				'#' => 'item-' . strval($newsItem->id), 
			)));
			if ($lastUpdateTime === null)
			{
				$lastUpdateTime = $newsItem->post_time;
			}
			// Поле 'description' не может содержать HTML-код. Преобразуем
			// HTML-описание в текст с помощью strip_tags().
			$description = strip_tags($newsItem->text);
			$feedEntries[] = array(
				'title' => $newsItem->title,
				'link' => $entryUrl,
				'guid' => $entryUrl,
				'description' => $description,
				'content' => $newsItem->text,
				'lastUpdate' => $newsItem->post_time,
			);
		}
		
		$feed = Zend_Feed::importArray(array(
			'title' => 'Новости сайта Школы системной соционики',
			'author' => 'Школа системной соционики',
			'link' => CHtml::encode($this->createAbsoluteUrl('')),
			'charset' => 'UTF-8',
			'lastUpdate' => $lastUpdateTime,
			'entries' => $feedEntries,
		), 'atom');
		$feed->send();
	}
}
