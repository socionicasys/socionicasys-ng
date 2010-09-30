<?php

/**
 * This is the model class for table "{{library}}".
 *
 * The followings are the available columns in table '{{library}}':
 * @property integer $id
 * @property string $type
 * @property string $url
 * @property string $title
 * @property string $author
 * @property string $published
 * @property string $text
 *
 * The followings are the available model relations:
 */
class Library extends CActiveRecord
{
	const TYPE_ARTICLE = 'statja';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Library the static model class
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
		return '{{library}}';
	}
	
	/**
	 * Перекрываем метод для заполнения результатов findAll() и подобных
	 * методов нужными нам моделями.
	 * 
	 * @param array $attributes
	 * @return Item
	 * @see db/ar/CActiveRecord::instantiate()
	 */
	protected function instantiate($attributes)
	{
		switch ($attributes['type'])
		{
		case self::TYPE_ARTICLE:
			$class = 'Article';
			break;
		default:
			$class = get_class($this);
		}
		$model = new $class(null);
		return $model;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, url, title, author, published', 'length', 'max'=>255),
			array('text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, url, title, author, published, text', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'url' => 'Url',
			'title' => 'Title',
			'author' => 'Author',
			'published' => 'Published',
			'text' => 'Text',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('published',$this->published,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}