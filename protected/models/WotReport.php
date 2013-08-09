<?php

class WotReport
{
	public static function report()
	{
		$sql=<<<SQL
SELECT
  pt.battle_count - pth.battle_count b,
  p.player_name,
  t.tank_localized_name,
  pt.updated_at,
  pth.updated_at hupdated_at,
  pt.battle_count,
  pth.battle_count hbattle_count,
  pt.win_count,
  pth.win_count hwin_count,
  pt.win_count - pth.win_count dwins,
  (pt.win_count - pth.win_count)/(pt.battle_count - pth.battle_count)*100 dwin_count,
  pt.win_count / pt.battle_count * 100 wp,
  pt.win_count / pt.battle_count * 100 - pth.win_count / pth.battle_count * 100 dwp
FROM wot_player_tank pt
  JOIN wot_player p ON p.player_id = pt.player_id
  JOIN wot_player_clan pc ON pc.player_id = p.player_id AND pc.escape_date IS NULL AND pc.clan_id = :clan
  JOIN wot_tank t ON t.tank_id = pt.tank_id
  JOIN (SELECT
    pt.player_id,
    pt.tank_id,
    (SELECT
      MIN(pth.updated_at)
    FROM wot_player_tank_history pth
    WHERE pth.updated_at > DATE_ADD(pt.updated_at, INTERVAL - 2 DAY)
    AND pth.player_id = pt.player_id
    AND pth.tank_id = pt.tank_id) last_updated_at
  FROM wot_player_tank pt) a ON a.player_id = pt.player_id AND a.tank_id = pt.tank_id
  JOIN wot_player_tank_history pth ON pth.player_id = a.player_id AND pth.tank_id = a.tank_id AND pth.updated_at = a.last_updated_at
WHERE pt.updated_at > DATE_ADD(NOW(), INTERVAL - 1 WEEK)
ORDER BY pt.player_id, pt.battle_count - pth.battle_count DESC
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function players()
	{
		$sql=<<<SQL
SELECT p.player_name
     , p.battles_count
     , p.created_at
     , p.battle_avg_xp
     , p.losses
     , p.wins
     , p.wins / p.battles_count * 100 AS wp
     , p.max_xp
     , datediff(now(), p.updated_at) updated_at
     , p.player_id
     , p.effect
     , p.wn6
     , p.damage_dealt/p.battles_count damage
FROM
  wot_player p
JOIN wot_player_clan pc
ON pc.player_id = p.player_id AND pc.escape_date IS NULL AND pc.clan_id = :clan
ORDER BY p.player_name
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}


	public static function medals()
	{
		$sql=<<<SQL
SELECT
  p.player_name,
  p.achievements
FROM
  wot_player p
  join wot_player_clan pc on pc.player_id=p.player_id and pc.escape_date is null and pc.clan_id=:clan
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		$result=array();
		foreach ($data as $row) {
			$res=unserialize($row['achievements']);
			$res['player_name']=$row['player_name'];
			$result[]=$res;
		}
		return $result;
	}

	public static function tanks()
	{
		$sql=<<<SQL
SELECT p.player_name
     , t.tank_localized_name
     , pt.battle_count
     , pt.win_count
     , pt.win_count / pt.battle_count * 100 AS wp
FROM
  wot_player p
JOIN wot_player_clan pc
ON pc.player_id = p.player_id AND pc.escape_date IS NULL AND pc.clan_id = :clan
JOIN wot_player_tank pt
ON pt.player_id = p.player_id
JOIN wot_tank t
ON t.tank_id = pt.tank_id AND t.tank_level = 10
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function members()
	{
		$sql=<<<SQL
SELECT wp.player_name, wp.player_id, wpc.entry_date, wp.created_at,
  datediff(now(),wpc.entry_date) dcnt, wcr.clan_role_name, wp.updated_at
  from wot_player_clan wpc
  join wot_player wp on wp.player_id=wpc.player_id
  join wot_clan_role wcr on wcr.clan_role_id=wpc.clan_role_id
  where wpc.clan_id=:clan and wpc.escape_date is null
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}


	public static function newMembers()
	{
		$sql=<<<SQL
SELECT
  wp.player_id,
  wp.player_name,
  wpc.entry_date,
  wcr.clan_role_name,
  DATEDIFF(NOW(),wpc.entry_date) days
FROM wot_player_clan wpc
  JOIN wot_player wp ON wp.player_id = wpc.player_id
  JOIN wot_clan_role wcr ON wcr.clan_role_id = wpc.clan_role_id
WHERE clan_id = :clan
AND wpc.escape_date IS NULL
AND wpc.entry_date > DATE_ADD(NOW(), INTERVAL - 1 WEEK)
ORDER BY wpc.entry_date DESC
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}


	public static function escapedMembers()
	{
		$sql=<<<SQL
select wp.player_id, wp.player_name, wpc.escape_date, datediff(wpc.escape_date,wpc.entry_date) days
  from wot_player_clan wpc
  join wot_player wp on wp.player_id=wpc.player_id
  where clan_id=:clan and wpc.escape_date > date_add(now(), interval -1 week)
  order by wpc.escape_date desc, days desc
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function career()
	{
		$sql=<<<SQL
SELECT
  wp.player_name,
  wcr.clan_role_name,
  wcr1.clan_role_name new_role,
  wpch.clan_history_date
FROM wot_player_clan_history wpch
  JOIN wot_clan_role wcr ON wcr.clan_role_id = wpch.clan_role_id
  JOIN wot_player wp ON wp.player_id = wpch.player_id
  JOIN wot_player_clan wpc ON wpc.clan_id = wpch.clan_id AND wpc.player_id = wp.player_id
  JOIN wot_clan_role wcr1 ON wcr1.clan_role_id = wpc.clan_role_id
WHERE wpch.clan_history_date>DATE_ADD(CURDATE(), INTERVAL - 1 WEEK) AND wpch.clan_id = :clan
ORDER BY wpch.clan_history_date DESC
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function top5effect()
	{
		$sql=<<<SQL
SELECT wp.player_name, wp.effect FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  ORDER BY wp.effect DESC
  LIMIT 5
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function top5damage()
	{
		$sql=<<<SQL
SELECT wp.player_name, ROUND(wp.damage_dealt/wp.battles_count,2) AS dmg FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  ORDER BY dmg DESC
  LIMIT 5
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function top5spotted()
	{
		$sql=<<<SQL
SELECT wp.player_name, ROUND(wp.spotted/wp.battles_count,2) AS spotted FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  ORDER BY spotted DESC
  LIMIT 5
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function top5capture()
	{
		$sql=<<<SQL
SELECT wp.player_name, ROUND(wp.capture_points/wp.battles_count,2) AS capture FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  ORDER BY capture DESC
  LIMIT 5
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function top5defense()
	{
		$sql=<<<SQL
SELECT wp.player_name, ROUND(wp.dropped_capture_points/wp.battles_count,2) AS defense FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  ORDER BY defense DESC
  LIMIT 5
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function newTanks()
	{
		$sql=<<<SQL
SELECT wp.player_id, wp.player_name, wt.tank_localized_name, wt.tank_image, wt.tank_level FROM wot_player_tank wpt
  JOIN wot_player wp ON wpt.player_id = wp.player_id
  JOIN wot_player_clan wpc ON wp.player_id = wpc.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  JOIN wot_tank wt ON wpt.tank_id = wt.tank_id
  WHERE wpt.created_at>DATE_ADD(NOW(), INTERVAL -2 DAY) AND wp.created_at<DATE_ADD(NOW(), INTERVAL - 3 DAY)
  ORDER BY wpt.created_at DESC
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function bestClass($class)
	{
		$sql=<<<SQL
SELECT wp.player_name, SUM(wpt.win_count)/SUM(wpt.battle_count)*100,SUM(wpt.damageDealt)/SUM(wpt.battle_count),SUM(wpt.battle_count),
  ((185/(0.17+ EXP((SUM(wpt.win_count)/SUM(wpt.battle_count)*100-35)*-0.134)))-500)*0.45+
  667*SUM(wpt.frags)/SUM(wpt.battle_count)+
  SUM(wpt.damageDealt)/SUM(wpt.battle_count)*0.24+
  SUM(wpt.spotted)/SUM(wpt.battle_count)*125 eff,
  ((185/(0.17+ EXP((SUM(wpt.win_count)/SUM(wpt.battle_count)*100-35)*-0.134)))-500)*0.45 a,
  667*SUM(wpt.frags)/SUM(wpt.battle_count) b,
  SUM(wpt.damageDealt)/SUM(wpt.battle_count)*0.24 c,
  SUM(wpt.spotted)/SUM(wpt.battle_count)*125 d
--  CASE case_operand
--    WHEN wpt.damageDealt/wpt.battle_count>wp.damage_dealt/wp.battles_count THEN 1+(wpt.damageDealt/wpt.battle_count-wp.damage_dealt/wp.battles_count)/(wp.)
--    ELSE
--  END

  FROM wot_player_tank wpt
  JOIN wot_player_clan wpc ON wpc.player_id=wpt.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  JOIN wot_tank wt ON wt.tank_id=wpt.tank_id
  JOIN wot_player wp ON wp.player_id=wpt.player_id
  WHERE wt.tank_level=8 AND wt.tank_class_id='SPG'
  GROUP BY wp.player_name
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function progress()
	{
		$sql=<<<SQL
SELECT wp.player_id
  ,wp.player_name
  ,wp.battles_count-wph.battles_count battles_count
  ,wph.updated_at
  ,wp.effect
  ,wp.effect-wph.effect heffect
  ,wp.wn6
  ,wp.wn6-wph.wn6 hwn6
  ,wp.wins/wp.battles_count*100 winp
  ,wp.wins/wp.battles_count*100 - wph.wins/wph.battles_count*100 hwinp
  ,wp.capture_points/wp.battles_count cp
  ,wp.capture_points/wp.battles_count-wph.capture_points/wph.battles_count hcp
  ,wp.spotted/wp.battles_count spotted
  ,wp.spotted/wp.battles_count-wph.spotted/wph.battles_count hspotted
  ,wp.hits_percents hitp
  ,wp.hits_percents-wph.hits_percents hhitp
  ,wp.dropped_capture_points/wp.battles_count dcp
  ,wp.dropped_capture_points/wp.battles_count-wph.dropped_capture_points/wph.battles_count hdcp
  ,wp.survived_battles/wp.battles_count sb
  ,wp.survived_battles/wp.battles_count-wph.survived_battles/wph.battles_count hsb
  ,wp.damage_dealt/wp.battles_count damage
  ,wp.damage_dealt/wp.battles_count-wph.damage_dealt/wph.battles_count hdamage
  ,wp.battle_avg_xp
  ,wp.battle_avg_xp-wph.battle_avg_xp hbattle_avg_xp
  ,wp.frags/wp.battles_count frags
  ,wp.frags/wp.battles_count-wph.frags/wph.battles_count hfrags
  ,wp.max_xp
  ,wp.max_xp-wph.max_xp hmax_xp
  FROM wot_player wp
  JOIN (
SELECT MIN(wph.updated_at) updated_at, wph.player_id
  FROM wot_player_history wph
  JOIN wot_player_clan wpc ON wpc.player_id=wph.player_id AND wpc.clan_id=:clan AND wpc.escape_date IS NULL
  WHERE wph.updated_at>DATE_ADD(NOW(), INTERVAL -2 day)
  GROUP BY wph.player_id) s ON s.player_id=wp.player_id
  JOIN wot_player_history wph ON wph.updated_at=s.updated_at AND wph.player_id=s.player_id
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function clanProgress()
	{
		$sql=<<<SQL
SELECT DATE_FORMAT(wph.updated_at,'%Y%m%d'), avg(wph.effect), avg(wph.wn6), MAX(wph.wins/wph.battles_count*100), a.wp, a.a6, a.ae, a.pc,
  (a.ae*a.pc-wp.effect+wph.effect)/a.pc deffect,
  (a.a6*a.pc-wp.wn6+wph.wn6)/a.pc dwn6,
  (a.wp*a.pc-wp.wins/wp.battles_count*100+wph.wins/wph.battles_count*100)/a.pc dwp
  FROM wot_player_history wph
  JOIN wot_player_clan wpc ON wpc.player_id=wph.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  JOIN wot_player wp ON wp.player_id=wph.player_id
  JOIN (SELECT AVG(wp.effect) ae, AVG(wp.wn6) a6, AVG(wp.wins/wp.battles_count)*100 wp, COUNT(1) pc
          FROM wot_player wp JOIN wot_player_clan wpc ON wpc.player_id=wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan ) a
  WHERE wph.effect>0
  GROUP BY  DATE_FORMAT(wph.updated_at,'%Y%m%d')
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function playerProgress($playerId)
	{
		$sql=<<<SQL
SELECT wph.player_id, UNIX_TIMESTAMP(DATE(wph.updated_at)) dd, MAX(wph.effect) effect, MAX(wph.wn6) wn6, MAX(wph.wins/wph.battles_count*100) wp
  FROM wot_player_history wph
  WHERE wph.player_id=:player AND wph.effect>0 AND DATE(wph.updated_at)<curdate() AND DATE(wph.updated_at)>date_add(curdate(), interval - 3 month)
  GROUP BY  DATE(wph.updated_at), wph.player_id
UNION
  (SELECT wp.player_id, UNIX_TIMESTAMP(DATE(wp.updated_at)), wp.effect,wp.wn6, wp.wins/wp.battles_count*100
    FROM wot_player wp
    WHERE wp.player_id=:player
  ORDER BY  wp.updated_at DESC LIMIT 1)
ORDER BY dd
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('player'=>$playerId));
		return $data;
	}

	public static function playerPresense()
	{
		$sql=<<<SQL
SELECT
  wp.player_id,
  wp.player_name,
  wcr.clan_role_name,
  a.dte,
  b.dts
FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
  JOIN wot_clan_role wcr ON wpc.clan_role_id = wcr.clan_role_id
  LEFT JOIN (SELECT
    wph.player_id,
    DATE(wph.updated_at) dte,
    MIN(wph.battles_count) bc
  FROM wot_player_history wph
    JOIN wot_player wp ON wph.player_id = wp.player_id
    JOIN wot_player_clan wpc ON wph.player_id = wpc.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
  WHERE wph.updated_at > DATE_ADD(CURDATE(), INTERVAL - 1 MONTH)
  GROUP BY wph.player_id, DATE(wph.updated_at)) a ON a.player_id = wp.player_id
  LEFT JOIN (SELECT
    wt.player_id,
    DATE(wt.updated_at) dts
  FROM wot_teamspeak wt
  WHERE TIME(wt.updated_at) BETWEEN TIME('20:00') AND TIME('24:00')
  GROUP BY wt.player_id, DATE(wt.updated_at)) b ON a.player_id = b.player_id AND a.dte = b.dts
SQL;

		$dates=array();
		for ($i = 14; $i >0; $i--) {
			$date = date_create('now');
			date_add($date, date_interval_create_from_date_string("-$i days"));
			$dates[]=date_format($date, 'Y-m-d');
		}

		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		$result=array();
		$names=array();

		foreach ($data as $row){
			if(!isset($result[$row['player_id']])){
				$result[$row['player_id']]=array('player_name'=>$row['player_name'],'clan_role_name'=>$row['clan_role_name']);
				foreach ($dates as $date){
					$result[$row['player_id']][$date]=0;
				}
			}
			if(!empty($row['dts']))
				$result[$row['player_id']][$row['dte']]=2;
			else
				$result[$row['player_id']][$row['dte']]=1;
		}
		$res=array();
		foreach ($result as $row){
			$res[]=$row;
		}
		return array('data'=>$res,'dates'=>$dates);
	}

	public static function playerProgressTanks($playerId, $date)
	{
		$sql=<<<SQL
SELECT
  wpth.battle_count-wpth1.battle_count bc,
 -- wpth.damageDealt/wpth.battle_count ddd,
--  wpth1.damageDealt/wpth1.battle_count ddddd,
--  wpth.damageDealt/wpth.battle_count-wpth1.damageDealt/wpth1.battle_count dd,
  wpth.win_count-wpth1.win_count wc,
  (wpth.win_count-wpth1.win_count)/(wpth.battle_count-wpth1.battle_count)*100 pw,
wt.tank_localized_name,
wp.player_name
  FROM wot_player_tank_history wpth
  JOIN (SELECT MAX(pth.updated_at) updated_at, pth.player_id, pth.tank_id
    FROM wot_player_tank_history pth
    WHERE pth.updated_at <  DATE_ADD(DATE(FROM_UNIXTIME(:date)),INTERVAL 1 DAY) AND pth.updated_at>DATE(FROM_UNIXTIME(:date))
    AND pth.player_id = :player_id
          GROUP BY pth.player_id, pth.tank_id
          ) last_updated_at ON last_updated_at.updated_at=wpth.updated_at AND last_updated_at.player_id=wpth.player_id AND last_updated_at.tank_id=wpth.tank_id
JOIN wot_player_tank_history wpth1 ON wpth.tank_id = wpth1.tank_id AND wpth.player_id = wpth1.player_id
JOIN (SELECT MAX(pth.updated_at) updated_at, pth.player_id, pth.tank_id
    FROM wot_player_tank_history pth
    WHERE pth.updated_at <  DATE_ADD(DATE(FROM_UNIXTIME(:date)),INTERVAL -1 DAY)
    AND pth.player_id = :player_id
          GROUP BY pth.player_id, pth.tank_id
          ) pre_updated_at ON pre_updated_at.updated_at=wpth1.updated_at AND pre_updated_at.player_id=wpth1.player_id AND pre_updated_at.tank_id=wpth1.tank_id
  JOIN wot_tank wt ON wt.tank_id=wpth.tank_id
  JOIN wot_player wp ON wp.player_id=wpth.player_id
ORDER BY bc DESC
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('player_id'=>$playerId, 'date'=>$date));
		return $data;
	}

}