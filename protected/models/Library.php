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
 * @property string $published_number
 * @property string $text
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * The followings are the available model relations:
 */
class Library extends CActiveRecord
{
	const TYPE_ARTICLE = 'statji';
	
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

	public function behaviors()
	{
		return array(
			'purge' => array(
				'class' => 'PurgeModelCache',
			),
		);
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
			array('type, title, author, published, published_number, meta_description, meta_keywords', 'length', 'max' => 255, 'encoding' => 'UTF-8'),
			array('text', 'filter', 'filter' => 'HtmlPurifierSetup::filter'),
			array('url', 'match',
				'pattern' => '/^[-a-z0-9_%+.]*$/',
				'message' => Yii::t('main', 'InvalidUrl'),
			),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, url, title, author, published, published_number, text', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('main', 'ID'),
			'type' => Yii::t('main', 'Type'),
			'url' => Yii::t('main', 'Utl'),
			'title' => Yii::t('main', 'Title'),
			'author' => Yii::t('main', 'Author'),
			'published' => Yii::t('main', 'PublishedAt'),
			'published_number' => Yii::t('main', 'PublishedIssue'),
			'text' => Yii::t('main', 'Text'),
            'meta_description' => Yii::t('main', 'MetaDescription'),
            'meta_keywords' => Yii::t('main', 'MetaKeywords'),
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
		$criteria->compare('published_number',$this->published_number,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if (empty($this->url))
			{
				$this->url = TextHelper::rus2translit($this->title);
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getUrl($absolute = false)
	{
		if ($absolute)
		{
			$create = 'createAbsoluteUrl';
		}
		else
		{
			$create = 'createUrl';
		}
		return Yii::app()->$create('library/view', array(
			'type' => $this->type,
			'title' => $this->url,
		));
	}
}
