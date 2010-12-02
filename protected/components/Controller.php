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
	 * @var string CSS-класс, применяющийся к контейнеру страницы
	 */
	public $layoutClass = 'narrow';

	/**
	 * @var string CSS-класс, применяющийся к содержимому
	 */
	public $contentClass;

	/**
	 * @var string мета-поле description текущей страницы
	 */
	public $pageDescription;

	/**
	 * @var string мета-поле keywords текущей страницы
	 */
	public $pageKeywords;
	
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

	public function getLayoutAttr()
	{
		if (!empty($this->layoutClass))
		{
			return 'class = "' . $this->layoutClass . '"';
		}
	    else
	    {
		    return '';
	    }
	}

	public function getContentAttr()
	{
		if (!empty($this->contentClass))
		{
			return 'class = "' . $this->contentClass . '"';
		}
	    else
	    {
		    return '';
	    }
	}

	public function getYears()
	{
		$year = date('Y');
		$startYear = '2010';
		if ($year === $startYear)
		{
			return $year;
		}
	    else
	    {
		    return $startYear . '&ndash;' . $year;
	    }
	}

	public function renderHeaderLinks()
	{
		if (Yii::app()->user->isGuest)
		{
			$label = 'Войти';
			$url = array('site/login');
		}
	    else
	    {
			$label = 'Выйти';
			$url = array('site/logout');
	    }
	    return CHtml::link($label, $url, array('class' => 'header-link'));
	}

	public function renderSidebarLinks()
	{
		return '';
	}

	public function init()
	{
		parent::init();
		$appParams = Yii::app()->params;
		if (isset($appParams['meta.description']))
		{
			$this->pageDescription = $appParams['meta.description'];
		}
		if (isset($appParams['meta.keywords']))
		{
			$this->pageKeywords = $appParams['meta.keywords'];
		}
	}

	protected function beforeRender($view)
	{
		if ($this->pageDescription !== null)
		{
			Yii::app()->clientScript->registerMetaTag($this->pageDescription, 'description');
		}
		if ($this->pageKeywords !== null)
		{
			Yii::app()->clientScript->registerMetaTag($this->pageKeywords, 'keywords');
		}
		return true;
	}

	public function renderRandomQuote()
	{
		return $this->widget('RandomQuote', array(), true);
	}
}
