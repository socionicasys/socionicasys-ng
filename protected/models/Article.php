<?php

class Article extends Library
{
	static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function init()
	{
		$this->type = Library::TYPE_ARTICLE;
	}
	
	public function defaultScope()
	{
		return array(
			'condition' => "type='" . Library::TYPE_ARTICLE . "'",
		);
	}
}
