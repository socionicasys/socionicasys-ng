<?php

/**
 * Класс авторизации пользователей через PhpBB3.
 * @author Grey Teardrop
 */
class PhpbbUserIdentity extends CUserIdentity
{
	/**
	 * @var string Путь к корневой директории PhpBB.
	 */
	public $phpbbRoot = 'webroot.forum';
	
	/**
	 * @var string расширение php-файлов в PhpBB.
	 */
	public $phpEx = 'php';
	
	private $_id;
	
	protected function getPhpbbPath()
	{
		$path = $this->phpbbRoot;
		if (strpos($path, DIRECTORY_SEPARATOR) === false)
		{
			// Если в пути не найдены разделители, интерпретируем его как псевдоним
			$path = Yii::getPathOfAlias($path);
		}
		if ($path[strlen($path) - 1] !== DIRECTORY_SEPARATOR)
		{
			$path .= DIRECTORY_SEPARATOR;
		}
		return $path;
	}

	public function authenticate()
	{
		// Глобальные переменные PhpBB :(
		global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template, $_SID;
		define('IN_PHPBB', true);
		define("IN_LOGIN", true);
		
		$phpbb_root_path = $this->getPhpbbPath();
		$phpEx = $this->phpEx;
		
		require_once($phpbb_root_path.'common.'.$phpEx);
		$user->session_begin();
		$auth->acl($user->data);
		
		$auth_result = login_db($this->username, $this->password);
		switch ($auth_result['status'])
		{
		case LOGIN_ERROR_USERNAME:
		case LOGIN_ERROR_ACTIVE:
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			break;
		case LOGIN_ERROR_ATTEMPTS:
		case LOGIN_ERROR_PASSWORD:
		case LOGIN_ERROR_PASSWORD_CONVERT:
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			break;
		case LOGIN_SUCCESS:
			$this->errorCode = self::ERROR_NONE;
			$phpbb_user_id = $auth_result['user_row']['user_id'];
			$phpbb_username = $auth_result['user_row']['username'];
			
			// Ищем в своей таблице БД соответствующего пользователя.
			// Если нет — создаем.
			$localUser = PhpbbUser::model()->findByAttributes(array(
				'phpbb_id' => $phpbb_user_id,
			));
			if ($localUser === null)
			{
				$localUser = new PhpbbUser();
				$localUser->username = $phpbb_username;
				$localUser->phpbb_id = $phpbb_user_id;
				$localUser->save();
			}
			$this->_id = $localUser->id;
			
			break;
		default:
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		}
		
		return $this->errorCode === self::ERROR_NONE;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}
