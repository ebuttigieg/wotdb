<?php

class WotProvince extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return WotProvince the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return WotProvince the static model class
	 */
	public static function getByAttributes($provinceName, $territoryId)
	{
		$model=self::model()->findByAttributes(array('province_name'=>$provinceName));
		if(empty($model)){
			$model=new WotProvince();
			$model->province_name=$provinceName;
			$model->territory_id=$territoryId;
			$model->save(false);
		}
		return $model;
	}	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wot_province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
		);
	}

}