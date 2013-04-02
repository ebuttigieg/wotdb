<?php

class WotPlayer extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return 'wot_player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array("spotted, hits_percents, capture_points, damage_dealt, frags, dropped_capture_points, wins, losses, battles_count, survived_battles, xp, battle_avg_xp, max_xp", 'numerical', 'integerOnly'=>true),
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

	
	public function calcRating()
	{
		$sql=<<<SQL
update wot_player wp
JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
JOIN (SELECT pt.player_id
           , sum(t.tank_level * pt.battle_count) midl
      FROM
        wot_player_tank pt
      JOIN wot_tank t
      ON t.tank_id = pt.tank_id
      GROUP BY
        pt.player_id
  ) a ON a.player_id = wp.player_id

  SET wp.wn6=(1240 - 1040 / power(least(a.midl / wp.battles_count, 6), 0.164)) * wp.frags / wp.battles_count +
       wp.damage_dealt / wp.battles_count * 530 / (184 * exp(0.24 * a.midl / wp.battles_count) + 130) +
       wp.spotted / wp.battles_count * 125 +
       least(wp.dropped_capture_points / wp.battles_count, 2.2) * 100 +
       ((185 / (0.17 + exp((wp.wins / wp.battles_count * 100 - 35) * -0.134))) - 500) * 0.45 +
       (6 - least(a.midl / wp.battles_count, 6)) * -60,
  wp.effect= wp.damage_dealt / wp.battles_count * (10 / (a.midl / wp.battles_count + 2)) * (0.23 + 2 * a.midl / wp.battles_count / 100) +
       250 * wp.frags / wp.battles_count +
       wp.spotted / wp.battles_count * 150 +
       log(1.732, wp.capture_points / wp.battles_count + 1) * 150 +
       wp.dropped_capture_points / wp.battles_count * 150
SQL;
		$this->getDbConnection()->createCommand($sql)->execute(array('clan'=>WotClan::$clanId));
	}
	
}