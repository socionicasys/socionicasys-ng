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
		// Определяем текущий пункт в меню
		$pathParts = explode('/', $requestUrl);
		$currentNode = null;
		for ($i = count($pathParts); $i > 1; $i--)
		{
			$path = implode('/', array_slice($pathParts, 0, $i));
			$currentNode = Nav::model()->findByAttributes(array(
				'url' => $path,
			));
			if ($currentNode !== null)
			{
				break;
			}
		}
		if ($currentNode === null)
		{
			$currentNode = Nav::model()->findByAttributes(array(
				'url' => '/',
			));
		}
		if ($currentNode === null)
		{
			throw new CHttpException(404, 'Страница не найдена');
		}
		
		// Главное меню
		$majorMenu = array();
		if (($toplevelNodes = Yii::app()->cache->get('model-nav-menu-toplevel')) === false)
		{
			$toplevelNodes = Nav::model()->findAllByAttributes(array(
				'level' => 2,
			));
			Yii::app()->cache->set('model-nav-menu-toplevel', $toplevelNodes, 600);
		}
		$currentToplevelNode = null;
		foreach ($toplevelNodes as $node)
		{
			$majorItem = array(
				'label' => $node->menu_title,
				'url' => $node->url,
			);
			if ($currentNode->isDescendantOf($node) || $currentNode->equals($node))
			{
				$majorItem['active'] = true;
				$currentToplevelNode = $node;
			}
			$majorMenu[] = $majorItem;
		}
		
		// Боковое меню и «хлебные крошки»
		$minorMenuNodes = $currentToplevelNode->descendants()->findAll();
		list($minorSubmenu, $breadcrumbs) =
			$this->renderTree($currentToplevelNode, $minorMenuNodes, $currentNode);
		
		$this->_majorMenu = $majorMenu;
		$this->_minorMenu = array($minorSubmenu);
		$this->_breadcrumbs = $breadcrumbs;
	}

	/**
	 * Преобразует линейный список в древовидный
	 * 
	 * @param Nav $root корень обрабатываемого дерева, не входит в
	 * результирующее меню
	 * @param array $items элементы дерева
	 * @param Nav $currentItem активный (выбранный) элемент
	 * @return array массив, первым элементом которого является боковое меню, а
	 * вторым — «хлебные крошки» для текущей страницы
	 */
	protected function renderTree($root, $items, $currentItem)
	{
		$position = 0;
		return $this->renderTreeInternal($root, $items, $currentItem, $position);
	}
	
	protected function renderTreeInternal($root, $items, $currentItem, &$position)
	{
		$menu = array(
			'label' => $root->menu_title,
			'url' => $root->url,
		);
		$childMenu = array();
		if ($currentItem->isDescendantOf($root))
		{
			$breadcrumbs = array($root->menu_title => $root->url);
		}
		elseif ($currentItem->equals($root))
		{
			unset($menu['url']);
			$breadcrumbs = array($root->menu_title);
		}
		else
		{
			$breadcrumbs = array();
		}
				
		while ($position < count($items))
		{
			$item = $items[$position];
			if (!$item->isDescendantOf($root))
			{
				break;
			}
			$position++;
			$subtree = $this->renderTreeInternal($item, $items, $currentItem, $position);
			
			$childMenu[] = $subtree[0];
			if (!empty($subtree[1]))
			{
				$breadcrumbs = array_merge($breadcrumbs, $subtree[1]);
			}
			
			if (($currentItem->isDescendantOf($item)
				|| $currentItem->equals($item))
				&& $item->type == Nav::TYPE_SECTION)
			{
				return array($subtree[0], $breadcrumbs);
			}
		}
		if (!empty($childMenu) && ($currentItem->isDescendantOf($root) || $currentItem->equals($root)))
		{
			$menu['items'] = $childMenu;
		}
		return array($menu, $breadcrumbs);
	}
}
