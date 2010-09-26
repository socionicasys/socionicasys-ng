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
	
	protected $_majorMenu;
	protected $_minorMenu;
	protected $_breadcrumbs;
	
	/**
	 * Элементы главного меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 * @return array
	 */
	public function getMajorMenu()
	{
		if ($this->_majorMenu !== null)
		{
			return $this->_majorMenu;
		}
		
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		
		if ($this->_menuManager === null)
		{
			$this->_majorMenu = array();
		}
		else
		{
			$this->_majorMenu = $this->_menuManager->getMajorMenu();
		}
		
		return $this->_majorMenu;
	}
	
	public function setMajorMenu($majorMenu)
	{
		$this->_majorMenu = $majorMenu;
	}

	/**
	 * Элементы бокового меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 * @return array
	 */
	public function getMinorMenu()
	{
		if ($this->_minorMenu !== null)
		{
			return $this->_minorMenu;
		}
		
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		
		if ($this->_menuManager === null)
		{
			$this->_minorMenu = array();
		}
		else
		{
			$this->_minorMenu = $this->_menuManager->getMinorMenu();
		}
		
		return $this->_minorMenu;
	}
	
	public function setMinorMenu($minorMenu)
	{
		$this->_minorMenu = $minorMenu;
	}
	
	/**
	 * «Хлебные крошки» текущей страницы. Данное свойство используется в качестве
	 * значения для {@link CBreadcrumbs::links}.
	 * @return array
	 */
	public function getBreadcrumbs()
	{
		if ($this->_breadcrumbs !== null)
		{
			return $this->_breadcrumbs;
		}
		
		if ($this->_menuManager === null)
		{
			$this->_menuManager = Yii::app()->getComponent('menuManager');
		}
		
		if ($this->_menuManager === null)
		{
			$this->_breadcrumbs = array();
		}
		else
		{
			$this->_breadcrumbs = $this->_menuManager->getBreadcrumbs();
		}
		
		return $this->_breadcrumbs;
	}
	
	public function setBreadcrumbs($breadcrumbs)
	{
		$this->_breadcrumbs = $breadcrumbs;
	}
}
