<?php

class PhpbbUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PhpbbUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{user}}';
	}

	public function rules()
	{
		return array(
			array('username, phpbb_id', 'required'),
			array('username', 'length', 'max'=>128),
		);
	}
}
