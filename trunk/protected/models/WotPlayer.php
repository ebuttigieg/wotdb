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


	public static function isClanPlayer($playerId)
	{
		$player=WotPlayerClan::model()->findByAttributes(array('clan_id'=>WotClan::$clanId,'player_id'=>$playerId),'escape_date is null');
		return !empty($player);
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
			'statistics'=>array(self::HAS_MANY, 'WotPlayerStatistic', 'player_id', 'index'=>'statisticName', 'with'=>array('statistic')),
			'achievments'=>array(self::HAS_MANY, 'WotPlayerAchievment', 'player_id', 'index'=>'achievmentName', 'with'=>array('achievment')),
			'stat'=>array(self::HAS_ONE, 'WotPlayerStatistic','player_id','condition'=>'WotPlayerStatistic.statistic_id=1'),
		);
	}

	public function getStatistic($statName)
	{
		$stats=$this->statistics;
		if(!isset($stats[$statName])){
			$stat=WotStatistic::model()->findByAttributes(array('statistic_name'=>$statName));
			if(empty($stat)){
				throw new CException('statistic is not defined!');
			}
			$playerStat = new WotPlayerStatistic();
			$playerStat->statistic_id=$stat->statistic_id;
			$playerStat->player_id=$this->player_id;
			$playerStat->save(false);
			$this->refresh();
			return $this->getStatistic($statName);
		}
		return $stats[$statName];
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		);
	}


	public static function calcRating()
	{
		$sql=<<<SQL
update wot_player wp
JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
JOIN wot_player_statistic wps ON wps.player_id=wp.player_id AND wps.statistic_id=1
JOIN (SELECT pt.player_id
           , sum(t.tank_level * pt.battles) midl
      FROM
        wot_player_tank pt
      JOIN wot_tank t
      ON t.tank_id = pt.tank_id
      GROUP BY
        pt.player_id
  ) a ON a.player_id = wp.player_id

  SET wp.wn6=(1240 - 1040 / power(least(a.midl / wps.battles, 6), 0.164)) * wps.frags / wps.battles +
       wps.damage_dealt / wps.battles * 530 / (184 * exp(0.24 * a.midl / wps.battles) + 130) +
       wps.spotted / wps.battles * 125 +
       least(wps.dropped_capture_points / wps.battles, 2.2) * 100 +
       ((185 / (0.17 + exp((wps.wins / wps.battles * 100 - 35) * -0.134))) - 500) * 0.45 +
       (6 - least(a.midl / wps.battles, 6)) * -60,
  wp.effect= wps.damage_dealt / wps.battles * (10 / (a.midl / wps.battles + 2)) * (0.23 + 2 * a.midl / wps.battles / 100) +
       250 * wps.frags / wps.battles +
       wps.spotted / wps.battles * 150 +
       log(1.732, wps.capture_points / wps.battles + 1) * 150 +
       wps.dropped_capture_points / wps.battles * 150
SQL;
		Yii::app()->db->createCommand($sql)->execute(array('clan'=>WotClan::$clanId));
	}

}