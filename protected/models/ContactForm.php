<?php

class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $body;
	public $verificationCode;

	public function rules()
	{
		return array(
			array('name, email, body', 'required'),
			array('email', 'email', 'checkMX' => true),
			array('verificationCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
			'name' => 'Имя',
			'email' => 'Ваш Email',
			'body' => 'Сообщение',
			'verificationCode' => 'Проверочный код',
		);
	}
}
