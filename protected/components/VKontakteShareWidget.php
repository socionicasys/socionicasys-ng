<?php

/**
 * Виджет «Опубликовать ВКонтакте» для кросспостинга ссылок с сайта.
 * http://vkontakte.ru/developers.php?o=-1&p=Share
 */
class VKontakteShareWidget extends CWidget
{
	/**
	 * @var mixed Адрес страницы, которая будет распространяться через виджет.
	 * По умолчанию — адрес текущей страницы.
	 */
	public $pageUrl;

	/**
	 * @var mixed Заголовок публикации. Если не указан, то будет браться со страницы публикации.
	 */
	public $pageTitle;

	/**
	 * @var mixed Описание публикации. Если не указано, то будет браться со страницы публикации.
	 */
	public $pageDesciption;

	/**
	 * @var mixed Ссылка на иллюстрацию к публикации. Если не указана, то будет браться со страницы публикации.
	 */
	public $pageImage;

	/**
	 * @var string Тип кнопки. Может принимать следующие значения:
	 *  - 'round' (значение по умолчанию) — кнопка со скругленными углами и со счетчиком ссылок;
	 *  - 'round_nocount' — кнопка со скругленными углами без счетчика ссылок;
	 *  - 'button' — кнопка с прямыми углами и со счетчиком ссылок;
	 *  - 'button_nocount' — кнопка с прямыми углами без счетчика ссылок;
	 *  - 'link' — текстовая ссылка с иконкой ВКонтакте;
	 *  - 'link_noicon' — текстовая ссылка без иконки;
	 *  - 'custom' — свой собственный код кнопки, задается в параметре $buttonText; 
	 */
	public $buttonType = 'round';

	/**
	 * @var string Для всех типов кнопки, кроме 'custom', задает текст на кнопке,
	 * для типа 'custom' этот параметр задает HTML-код кнопки. 
	 */
	public $buttonText = 'Сохранить';

	/**
	 * @var mixed Если значение false, то сервер ВКонтакте не будет делать дополнительный запрос для загрузки
	 * недостающей информации с публикуемой страницы. Если же значение false, то запрос будет отправляться
	 * всегда. По умолчанию запрос отправляется в том случае, если заполнены не все поля из
	 * $pageTitle, $pageDesciption, $pageImage.
	 */
	public $parsePage;

	public function __construct($owner = null)
	{
		parent::__construct($owner);
		if ($this->pageUrl === null)
		{
			$this->pageUrl = '';
		}
		$this->pageUrl = Yii::app()->getRequest()->getHostInfo() . CHtml::normalizeUrl($this->pageUrl);
		if ($this->getId(false) === null)
		{
			$this->setId('vkontakte-share-widget');
		}
	}

	public function run()
	{
		Yii::app()->clientScript->registerScriptFile('http://vkontakte.ru/js/api/share.js?10',
			CClientScript::POS_HEAD, false);

		$id = $this->getId();

		$contentParameter = array(
			'url' => $this->pageUrl,
		);
		if ($this->pageTitle !== null)
		{
			$contentParameter['title'] = $this->pageTitle;
		}
		if ($this->pageDesciption !== null)
		{
			$contentParameter['desciption'] = $this->pageDesciption;
		}
		if ($this->pageImage !== null)
		{
			$contentParameter['image'] = $this->pageImage;
		}
		if ($this->parsePage === null)
		{
			$this->parsePage = ($this->pageTitle === null)
				|| ($this->pageDesciption === null)
				|| ($this->pageImage);
		}
		$contentParameter['noparse'] = !($this->parsePage);
		$contentParameter = CJavaScript::encode($contentParameter);

		$buttonParameter = array(
			'type' => $this->buttonType,
			'text' => $this->buttonText,
		);
		$buttonParameter = CJavaScript::encode($buttonParameter);

		Yii::app()->clientScript->registerScript($id,
			"document.getElementById('$id').innerHTML = VK.Share.button(
				$contentParameter,
				$buttonParameter
			);",
			CClientScript::POS_READY);
		$this->render('vkontakte-share', array(
			'id' => $id,
			'url' => $this->pageUrl,
			'label' => $this->buttonText,
		));
	}
}
