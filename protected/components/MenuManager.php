<?php

/**
 * MenuManager занимается разбиением полного дерева страниц на главное меню,
 * вспомогательное меню и «хлебные крошки». 
 * 
 * @author Grey Teardrop
 */
class MenuManager extends CApplicationComponent
{
	/**
	 * @var mixed дерево всех страниц в формате, совместимом с zii.widgets.CMenu.
	 * Если параметр содержит строку, она используется как ключ в массиве
	 * параметов приложения Yii::app()->params.
	 */
	public $pageTree = array();
	
	/**
	 * @var array содержит массив, описывающий главное меню, в формате,
	 * пригодном для использования в zii.widgets.CMenu
	 */
	protected $_majorMenu;
	
	/**
	 * @var array содержит массив, описывающий боковое меню, в формате,
	 * пригодном для использования в zii.widgets.CMenu
	 */
	protected $_minorMenu;

	/**
	 * @var array содержит массив, описывающий «хлебные крошки», в формате,
	 * пригодном для использования в zii.widgets.CBreadcumbs
	 */
	protected $_breadcrumbs;
	
	/**
	 * Инициализирует компоненту MenuManager
	 * @see base/CApplicationComponent::init()
	 */
	public function init()
	{
		if (is_string($this->pageTree))
		{
			$this->pageTree = Yii::app()->params[$this->pageTree];
		}
		if (!is_array($this->pageTree))
		{
			$this->pageTree = array();
		}
		if (!isset($this->pageTree['items']))
		{
			$this->pageTree['items'] = array();
		}
		$this->updateMenus(Yii::app()->getRequest()->getUrl());
		parent::init();
	}
	
	public function getMajorMenu()
	{
		return $this->_majorMenu;
	}
	
	public function getMinorMenu()
	{
		return $this->_minorMenu;
	}
	
	public function getBreadcrumbs()
	{
		return $this->_breadcrumbs;
	}
	
	/**
	 * По общему дереву страниц и текущему адресу запроса инициализирует свойства
	 * majorMenu, minorMenu, breadcrumbs.
	 * @param $requestUrl string адрес текущего запроса
	 * @return void
	 */
	public function updateMenus($requestUrl)
	{
		$majorMenu = array();
		$minorMenu = array();
		$breadcrumbs = array();
		
		$activeFound = false;
		foreach ($this->pageTree['items'] as $menu)
		{
			if (!is_array($menu))
			{
				$menu = array();
			}
			
			$majorItem = $menu;
			if (isset($menu['items']))
			{
				unset($majorItem['items']);
			}
			else
			{
				$menu['items'] = array();
			}
			
			if (!$activeFound)
			{
				$breadcrumbs = $this->scanSubmenu($menu, $requestUrl);
				if ($breadcrumbs !== null)
				{
					$minorMenu = array($menu);
					$majorItem['active'] = true;
					$activeFound = true;
				}
			}
			$majorMenu[] = $majorItem;
		}
		
		$this->_majorMenu = $majorMenu;
		$this->_minorMenu = $minorMenu;
		$this->_breadcrumbs = $breadcrumbs;
	}
	
	/**
	 * Рекурсивно сканирует данное меню, если находит в нем ссылку на заданный
	 * адрес, возвращает «хлебные крошки» для него, и выделяет в меню только
	 * активную ветвь.
	 * @param array $menu
	 * @param string $requestUrl
	 */
	protected function scanSubmenu(&$menu, $requestUrl)
	{
		if (!isset($menu['url']) || !isset($menu['label']))
		{
			return null;
		}
		
		$menuUrl = CHtml::normalizeUrl($menu['url']);
		$isHomeUrl = ($menuUrl === Yii::app()->getHomeUrl());
		$breadcrumbsLeaf = null;
		
		// Проверяем, совпадает ли адрес текущего меню с запрошенным (или
		// его началом). В случае, если запрошенный адрес начинается с адреса
		// текущего меню, и лучших совпадений в подменю не найдено, будем
		// использовать этот пункт для «хлебных крошек» и текущего пункта меню. 
		if (strpos($requestUrl, $menuUrl) === 0)
		{
			$exactMatch = $menuUrl === $requestUrl;
			if ($isHomeUrl)
			{
				if ($exactMatch)
				{
					$breadcrumbsLeaf = array();
				}
			}
			else
			{
				$breadcrumbsLeaf = array($menu['label']);
			}
		}
		if (!isset($menu['items']))
		{
			if ($breadcrumbsLeaf !== null && $exactMatch)
			{
				unset($menu['url']);
			}
			return $breadcrumbsLeaf;
		}
		
		// Сканируем подменю данного меню. Если среди них надется то, которое
		// содержит ссылку на $requestUrl, то оставляем $menu как есть, иначе
		// прячем все подменю этого меню.
		$breadcrumbs = null;
		foreach ($menu['items'] as &$item)
		{
			$breadcrumbsSubmenu = $this->scanSubmenu($item, $requestUrl);
			if ($breadcrumbsSubmenu !== null)
			{
				if ($isHomeUrl)
				{
					$breadcrumbs = $breadcrumbsSubmenu;
				}
				else
				{
					$currentElement = array($menu['label'] => $menu['url']);
					$breadcrumbs = array_merge($currentElement, $breadcrumbsSubmenu);
				}
			}
		}
		
		if ($breadcrumbs !== null)
		{
			return $breadcrumbs;
		}
		else if ($breadcrumbsLeaf !== null)
		{
			if ($exactMatch)
			{
				unset($menu['url']);
			}
			return $breadcrumbsLeaf;
		}
		else
		{
			unset($menu['items']);
			return null;
		}
	}
}
