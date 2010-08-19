<?php

class UserIdentity extends CUserIdentity
{
	private $_id;
	
	public function authenticate()
	{
		// Сначала ищем точное совпадение
		$username = $this->username;
		$user = User::model()->findByAttributes(array(
			'username' => $username,
		));
		if ($user === null)
		{
			// Если точное имя не найдено, ищем без учета регистра
			if (function_exists('mb_strtolower'))
			{
				$username = mb_strtolower($username, 'utf-8');
			}
			else
			{
				$username = strtolower($username);
			}
			$user = User::model()->find('LOWER(username)=?', array($username));
		}
		if ($user === null)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (!$user->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$this->_id = $user->id;
			$this->username = $user->username;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode === self::ERROR_NONE;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}
