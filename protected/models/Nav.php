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
 * @property boolean $wide_layout
 *
 * The followings are the available model relations:
 */
class Nav extends CActiveRecord
{
	const TYPE_PAGE = 0;
	const TYPE_SECTION = 1;
	
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
			array('text', 'filter', 'filter' => 'HtmlPurifierSetup::filter'),
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

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord && empty($this->url))
			{
				$parent = $this->parent();
				$this->url = '/' . trim($parent->url, '/') . '/' .
					$this->rus2translit($this->menu_title);
			}
			return true;
		}
		else
		{
			return false;
		}
	}
		
	/**
	 * Функция необратимой транслитерации для SEO.
	 * Текст в таком транслите утрачивает однозначность и восстановлению не поделижит,
	 * (при этом всё-таки сохраняя читабельность для посетителей сайта)
	 * так же как *не может* быть напрямую использован как уникальный идентификатор
	 * при соответствующем ограничении наложенном на кириллический заголовок.
	 * Данную проблему можно решить двумя путями - ставить ограничение именно на
	 * транслитерированный заголовок, для чего завести в базе соответствующее поле,
	 * либо дополнять ссылку реальным идентификатором.
	 *
	 * Но при всех недостатках этот транслит понятен поисковикам
	 * и послужит дополнительным бонусом при ранжировании поисковой
	 * выдачи (за некоторыми исключениями, описанными в этой статье:
	 * http://blessmaster.livejournal.com/115715.html
	 *
	 * @param string $text текст для транслитерации
	 * @return string транслитерированную строку
	 * @author BlessMaster (deep-dream@ya.ru)
	 */
	public function rus2translit($text)
	{
		$text = mb_strtoupper($text, 'UTF-8');
	
		$exchange = array(
			'А'=>'a',
			'Б'=>'b',
			'В'=>'v',
			'Г'=>'g',
			'Д'=>'d',
			'Е'=>'e',
			'Ё'=>'e',
			'Ж'=>'zh',
			'З'=>'z',
			'И'=>'i',
			'Й'=>'j',
			'К'=>'k',
			'Л'=>'l',
			'М'=>'m',
			'Н'=>'n',
			'О'=>'o',
			'П'=>'p',
			'Р'=>'r',
			'С'=>'s',
			'Т'=>'t',
			'У'=>'u',
			'Ф'=>'f',
			'Х'=>'h',
			'Ц'=>'c',
			'Ч'=>'ch',
			'Ш'=>'sh',
			'Щ'=>'shch',
			'Ъ'=>'',
			'Ы'=>'y',
			'Ь'=>'',
			'Э'=>'e',
			'Ю'=>'ju',
			'Я'=>'ja',
			' '=>'-', // сохраняем пробел от перехода в %20 понятным гуглу способом
			','=>'',
			"'"=>'-',
		);
		$text = str_replace(array_keys($exchange), array_values($exchange), $text);
		// Остальные символы - уже никуда не денешься
		$text = rawurlencode($text);
		return $text;
	}
	
	public function getUrl()
	{
		return Yii::app()->createUrl('page/view', array(
			'path' => trim($this->url, '/'),
		));
	}
}
