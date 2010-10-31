<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $post_time
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
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
		return '{{news}}';
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text', 'required'),
			array('title', 'length', 'max'=>256),
			array('text', 'filter', 'filter' => 'HtmlPurifierSetup::filter'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, text', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок новости',
			'text' => 'Текст новости',
			'post_time' => 'Дата публикации',
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

		$criteria->compare('title',$this->title,true);

		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Возвращает список критериев, применяющихся по-умолчанию к SELECT-запросам.
	 * Список новостей по умолчанию сортируется в обратном хронологическом
	 * порядке.
	 * @see db/ar/CActiveRecord::defaultScope()
	 */
	public function defaultScope()
	{
		return array(
			'order' => 'post_time DESC',
		);
	}
	
	/**
	 * Перед сохранением новой записи автоматически добавляет к ней дату
	 * создания.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->post_time = time();
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
		return Yii::app()->$create('news/item', array(
			'id' => $this->id,
		));
	}
}
