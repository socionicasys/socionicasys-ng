<?php
/**
 * Controller — базовый класс для контроллеров приложения. Задает layout
 * по-умолчанию, а автоматически заполняет поля $majorMenu, $minorMenu,
 * $breadcrumbs, которые при необходимости может изменить контроллер-наследник
 * или предсталение
 */
class Controller extends RightsBaseController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/full';
	
	/**
	 * @var MenuManager компонент управления меню
	 */ 
	protected $_menuManager;
	
	/**
	 * Элементы главного меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 * @return array
	 */
	public function getMajorMenu()
	{
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		if ($this->_menuManager === null)
		{
			return array();
		}
		else
		{
			return $this->_menuManager->getMajorMenu();
		}
	}

	/**
	 * Элементы бокового меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 * @return array
	 */
	public function getMinorMenu()
	{
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		if ($this->_menuManager === null)
		{
			return array();
		}
		else
		{
			return $this->_menuManager->getMinorMenu();
		}
	}

	/**
	 * «Хлебные крошки» текущей страницы. Данное свойство используется в качестве
	 * значения для {@link CBreadcrumbs::links}.
	 * @return array
	 */
	public function getBreadcrumbs()
	{
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		if ($this->_menuManager === null)
		{
			return array();
		}
		else
		{
			return $this->_menuManager->getBreadcrumbs();
		}
	}
}
