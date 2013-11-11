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