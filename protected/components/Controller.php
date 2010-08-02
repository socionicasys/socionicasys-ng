<?php
/**
 * Controller — базовый класс для контроллеров приложения. Задает layout
 * по-умолчанию, а автоматически заполняет поля $majorMenu, $minorMenu,
 * $breadcrumbs, которые при необходимости может изменить контроллер-наследник
 * или предсталение
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array элементы главного меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 */
	public $majorMenu = array();
	/**
	 * @var array элементы бокового меню. Это свойство будет использовано в
	 * {@link CMenu::items}.
	 */
	public $minorMenu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	
	protected function beforeAction($action)
	{
		$mm = Yii::app()->getComponent('menuManager');
		if ($mm !== null)
		{
			$this->majorMenu = $mm->getMajorMenu();
			$this->minorMenu = $mm->getMinorMenu();
			$this->breadcrumbs = $mm->getBreadcrumbs();
		}
		return parent::beforeAction($action);
	}
}
