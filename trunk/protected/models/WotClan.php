<?php
/**
 * @property WotPlayer[] $players
 * 
 * @author Андрей
 *
 */
class WotClan extends CActiveRecord
{
	
	public static $clanId=93535;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return WotClan the static model class
	 */
	public static function currentClan()
	{
		return self::model()->findByPk(self::$clanId);
	}	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wot_clan';
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
			'players'=>array(self::MANY_MANY,'WotPlayer','wot_player_clan(player_id,clan_id)','condition'=>'escape_date is null', 'index'=>'player_id'),
			'playersRec'=>array(self::HAS_MANY,'WotPlayerClan','clan_id','condition'=>'escape_date is null', 'index'=>'player_id'),
			'clanProvinces'=>array(self::HAS_MANY,'WotClanProvince','clan_id', 'condition'=>'date_end is null', 'with'=>array('province'), 'index'=>'province_id'),
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