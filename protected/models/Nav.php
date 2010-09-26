<?php

/**
 * This is the model class for table "{{nav}}".
 *
 * The followings are the available columns in table '{{nav}}':
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $type
 * @property string $url
 * @property string $title
 * @property string $menu_title
 * @property string $text
 *
 * The followings are the available model relations:
 */
class Nav extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Nav the static model class
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
		return '{{nav}}';
	}
	
	public function behaviors()
	{
		return array(
			'tree' => array(
				'class' => 'ext.yiiext.behaviors.model.trees.ENestedSetBehavior',
				'hasManyRoots' => false,
				'root' => 'root',
				'left' => 'lft',
				'right' => 'rgt',
				'level' => 'level',
			),		
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('url, title, menu_title', 'length', 'max'=>255),
			array('menu_title', 'required'),
			array('url', 'match',
				'pattern' => '/^(\/[-a-z0-9_%+.]+)*\/?$/',
				'message' => 'Адрес может содержать только символы a-z, 0-9, -, _, %, +, .',
			),
			array('text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, type, url, title, menu_title, text', 'safe', 'on'=>'search'),
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
			'url' => 'Адрес страницы',
			'title' => 'Заголовок в браузере',
			'menu_title' => 'Заголовок в меню',
			'text' => 'Текст',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('root',$this->root);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('type',$this->type);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('menu_title',$this->menu_title,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}