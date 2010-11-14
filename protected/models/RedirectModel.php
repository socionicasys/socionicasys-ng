<?php

/**
 * This is the model class for table "{{redirect}}".
 *
 * The followings are the available columns in table '{{redirect}}':
 * @property integer $id
 * @property string $group
 * @property string $page
 * @property string $model_class
 * @property integer $model_id
 * @property string $path
 *
 * The followings are the available model relations:
 */
class RedirectModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RedirectModel the static model class
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
		return '{{redirect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id', 'numerical', 'integerOnly'=>true),
			array('group, page', 'length', 'max'=>2),
			array('model_class', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group, page, model_class, model_id', 'safe', 'on'=>'search'),
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
			'group' => 'Group',
			'page' => 'Page',
			'model_class' => 'Model Class',
			'model_id' => 'Model',
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
		$criteria->compare('group',$this->group,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('model_class',$this->model_class,true);
		$criteria->compare('model_id',$this->model_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}