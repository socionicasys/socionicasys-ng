<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $link
 * @property integer $post_time
 * @property string $comment
 * @property string $category
 * @property string $date
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Video the static model class
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
		return '{{video}}';
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
			array('title, link', 'required'),
			array('post_time', 'numerical', 'integerOnly'=>true),
			array('title, url, link, category, date', 'length', 'max'=>255),
			array('comment', 'filter', 'filter' => 'HtmlPurifierSetup::filter'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, url, link, post_time, comment, category, date', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок',
			'url' => 'Адрес для сайта',
			'link' => 'Ссылка на видео',
			'post_time' => 'Дата добавления',
			'comment' => 'Комментарий',
			'category' => 'Тема',
			'date' => 'Год',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('post_time',$this->post_time);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
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
		return Yii::app()->$create('video/view', array(
			'id' => $this->id,
		));
	}
}
