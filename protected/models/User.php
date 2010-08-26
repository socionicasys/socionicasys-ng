<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('username, password', 'length', 'max'=>128),

			array('id, username, password', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	// При сохранении новой записи сгенерировать новую
	// «соль», хешировать пароль и сохранить в БД хешированный вариат.
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			// Если запись новая или пароль был изменен
			if ($this->isNewRecord)
			{
				$this->salt = $this->generateSalt();
				$this->password = $this->hashPassword($this->password, $this->salt);
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Проверяет, соответствует ли заданный пароль хешу из БД.
	 * @param string $password пароль, который нужно проверить
	 * @return boolean правилен ли пароль
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password, $this->salt) === $this->password;
	}
	
	/**
	 * Хеширует пароль. 
	 * @param string $password пароль в открытом виде
	 * @param string $salt «соль»
	 * @return string хеш пароля
	 */
	public function hashPassword($password, $salt)
	{
		return md5($salt . $password);
	}
	
	/**
	 * Генерирует случайную «соль» для использования в алгоритме хеширования.
	 * @return string сгенерированная «соль»
	 */
	protected function generateSalt()
	{
		return md5(uniqid('', true));
	}
}
