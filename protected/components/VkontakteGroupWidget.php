<?php

/**
 * Виджет для сообществ ВКонтакте
 * http://vkontakte.ru/developers.php?o=-1&p=Groups
 */
class VkontakteGroupWidget extends CWidget
{
	/**
	 * @var int идентификатор группы ВКонтакте, для которой отображается виджет
	 */
	public $groupId;

	/**
	 * @var int ширина виджета в пикселях
	 */
	public $width = 200;

	/**
	 * @var boolean отображать ли в виджете список участников
	 */
	public $displayMembers = true;

	public function __construct($owner = null)
	{
		parent::__construct($owner);
		if ($this->getId(false) === null)
		{
			$this->setId('vkontakte-group-widget');
		}
	}

	public function run()
	{
		if ($this->groupId === null)
		{
			throw new CException('Required attribute groupId is empty');
		}
		Yii::app()->clientScript->registerScriptFile('http://vkontakte.ru/js/api/openapi.js',
			CClientScript::POS_HEAD, false);

		$id = $this->getId();
		$options = CJavaScript::encode(array(
			'mode' => $this->displayMembers ? 0 : 1,
			'width' => $this->width,
		));
		$group = $this->groupId;

		Yii::app()->clientScript->registerScript($id,
			"VK.Widgets.Group('$id', $options, $group);",
			CClientScript::POS_READY);

		echo CHtml::tag('div', array('id' => $id));
	}
}
