<?php

class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $body;

	public function rules()
	{
		return array(
			array('name, email, body', 'required'),
			array('email', 'email', 'checkMX' => true),
		);
	}

	public function attributeLabels()
	{
		return array(
			'name' => 'Имя',
			'email' => 'Ваш Email',
			'body' => 'Сообщение',
		);
	}
}
