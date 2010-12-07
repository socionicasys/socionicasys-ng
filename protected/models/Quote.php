<?php

/**
 * This is the model class for table "{{quote}}".
 *
 * The followings are the available columns in table '{{quote}}':
 * @property integer $id
 * @property string $author
 * @property string $note
 * @property string $text
 *
 * The followings are the available model relations:
 */
class Quote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Quote the static model class
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
		return '{{quote}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('author, note', 'length', 'max' => 255),
			array('text', 'filter', 'filter' => 'HtmlPurifierSetup::filter'),
			array('id, author, note, text', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author' => 'Автор',
			'note' => 'Комментарий',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
