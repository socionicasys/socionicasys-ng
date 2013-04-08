<?php

/**
 * Модель для формы логина.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	
	private $_identity;
	
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('rememberMe', 'boolean'),
			array('password', 'authenticate', 'skipOnError' => true),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'username' => Yii::t('main', 'Username'),
			'password' => Yii::t('main', 'Password'),
			'rememberMe' => Yii::t('main', 'RememberMe'),
		);
	}
	
	public function authenticate($attribute = null, $params = null)
	{
		$this->_identity = new PhpbbUserIdentity($this->username, $this->password);
		if (isset(Yii::app()->params['phpbb.root']))
		{
			$this->_identity->phpbbRoot = Yii::app()->params['phpbb.root'];
		}
		if (!$this->_identity->authenticate())
		{
			if ($this->_identity->errorCode === UserIdentity::ERROR_USERNAME_INVALID)
			{
				$this->addError('username', 'Неверное имя пользователя');
			}
			else
			{
				$this->addError('password', 'Неверный пароль');
			}
		}
	}
	
	public function login()
	{
		if ($this->_identity === null)
		{
			$this->authenticate();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = $this->rememberMe? 3600 * 24 * 30 : 0; // 30 дней
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else
		{
			return false;
		}
	}
}
