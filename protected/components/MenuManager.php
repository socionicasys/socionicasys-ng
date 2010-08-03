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
					//$minorMenu = array_merge(array($majorItem), $menu['items']);
					$minorMenu = $menu['items'];
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
	 * адрес, возвращает «хлебные крошки» для него, 
	 * @param array $menu
	 * @param string $requestUrl
	 */
	protected function scanSubmenu($menu, $requestUrl)
	{
		$menuUrl = CHtml::normalizeUrl($menu['url']);
		$isHomeUrl = ($menuUrl === Yii::app()->getHomeUrl());
		if (isset($menu['url']) && $menuUrl === $requestUrl)
		{
			if ($isHomeUrl)
			{
				return array();
			}
			else
			{
				return array($menu['label']);
			}
		}
		else if (!isset($menu['items']))
		{
			return null;
		}
		
		foreach ($menu['items'] as $item)
		{
			$breadcrumbs = $this->scanSubmenu($item, $requestUrl);
			if ($breadcrumbs !== null)
			{
				if ($isHomeUrl)
				{
					return $breadcrumbs;
				}
				else
				{
					$currentElement = array($menu['label'] => $menu['url']);
					return array_merge($currentElement, $breadcrumbs);
				}
			}
		}
		
		return null;
	}
}
