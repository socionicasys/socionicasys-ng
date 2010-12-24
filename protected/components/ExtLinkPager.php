<?php

class ExtLinkPager extends CLinkPager
{
	protected function createPageButton($label, $page, $class, $hidden, $selected)
	{
		if ($hidden || $selected)
		{
			$class .= ' ' . ($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		}
		if ($hidden)
		{
			$link = CHtml::link($label, '');
		}
		else
		{
			$link = CHtml::link($label,$this->createPageUrl($page));
		}
		return '<li class="' . $class . '">' . $link . '</li>';
	}
}
