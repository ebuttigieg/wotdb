<?php

class WotReport
{
	public static function report()
	{
		$sql=<<<SQL
SELECT pt.battle_count - pth.battle_count b
     , p.player_name
     , t.tank_localized_name
     , pt.updated_at
     , pth.updated_at hupdated_at
     , pt.battle_count
     , pth.battle_count hbattle_count
     , pt.win_count
     , pth.win_count hwin_count
     , pt.win_count / pt.battle_count * 100 wp
FROM
  wot_player_tank pt
JOIN wot_player p
ON p.player_id = pt.player_id
  join wot_player_clan pc on pc.player_id=p.player_id and pc.escape_date is NULL and pc.clan_id=:clan
JOIN wot_tank t
ON t.tank_id = pt.tank_id
JOIN
  (SELECT pt.player_id
        , pt.tank_id
        , (SELECT min(pth.updated_at)
           FROM
             wot_player_tank_history pth
           WHERE
             pth.updated_at > date_add(pt.updated_at, INTERVAL -2 DAY)
             AND pth.player_id = pt.player_id
             AND pth.tank_id = pt.tank_id) last_updated_at
   FROM
     wot_player_tank pt) a
ON a.player_id = pt.player_id AND a.tank_id = pt.tank_id
JOIN wot_player_tank_history pth
ON pth.player_id = a.player_id AND pth.tank_id = a.tank_id AND pth.updated_at = a.last_updated_at
WHERE
  pt.updated_at > date_add(now(), INTERVAL -1 WEEK)
ORDER BY
  pt.player_id
, pt.battle_count - pth.battle_count DESC
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
     , datediff(now(), ifnull(l.updated_at, p.updated_at)) updated_at
     , p.player_id
     ,  p.damage_dealt/p.battles_count * (10 / (a.midl/p.battles_count+ 2)) * (0.23 + 2*a.midl/p.battles_count/ 100)+
        250 * p.frags / p.battles_count +
        p.spotted / p.battles_count * 150+
      log(1.732, p.capture_points / p.battles_count + 1) * 150+
      p.dropped_capture_points / p.battles_count * 150 effect
     , (1240-1040/power(LEAST(a.midl/p.battles_count,6),0.164))*p.frags/p.battles_count+
      p.damage_dealt/p.battles_count*530/(184*exp(0.24*a.midl/p.battles_count)+130)+
      p.spotted/p.battles_count*125+
      least(p.dropped_capture_points/p.battles_count,2.2)*100+
      ((185/(0.17+exp((p.wins/p.battles_count*100-35)*-0.134)))-500)*0.45+
      (6-least(a.midl/p.battles_count,6))*-60 wn6
FROM wot_player p
JOIN wot_player_clan pc ON pc.player_id = p.player_id AND pc.escape_date IS NULL AND pc.clan_id = :clan
LEFT JOIN (SELECT pth.player_id
                , max(pth.updated_at) AS updated_at
           FROM wot_player_tank_history pth
           GROUP BY pth.player_id) l ON l.player_id = p.player_id
JOIN (SELECT pt.player_id
           , sum(t.tank_level * pt.battle_count) midl
      FROM
        wot_player_tank pt
      JOIN wot_tank t ON t.tank_id = pt.tank_id
      GROUP BY pt.player_id
  ) a ON a.player_id = p.player_id
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
ON t.tank_id = pt.tank_id AND ((t.tank_level = 10 AND t.tank_class_id IN ('AT-SPG', 'heavyTank', 'mediumTank')) OR (t.tank_level = 8) AND t.tank_class_id = 'SPG')
SQL;
		$data=Yii::app()->db->cache(3600)->createCommand($sql)->queryAll(true,array('clan'=>WotClan::$clanId));
		return $data;
	}

	public static function members()
	{
		$sql=<<<SQL
SELECT wp.player_name, wp.player_id, wpc.entry_date,
  datediff(now(),wpc.entry_date), wcr.clan_role_name, wp.updated_at
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
select wp.player_id, wp.player_name, wpc.entry_date
  from wot_player_clan wpc
  join wot_player wp on wp.player_id=wpc.player_id
  where clan_id=:clan and wpc.escape_date is null and wpc.entry_date > date_add(now(), interval -1 week)
  order by wpc.entry_date desc
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

}