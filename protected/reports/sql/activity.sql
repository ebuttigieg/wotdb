SELECT
  wpt.battles - wpth.battles b,
  wp.player_name,
  wt.tank_name_i18n AS tank_localized_name,
  wpt.updated_at,
  wpth.updated_at hupdated_at,
  wpt.battles,
  wpth.battles hbattle_count,
  wpt.wins,
  wpth.wins hwin_count,
  wpt.wins - wpth.wins dwins,
  (wpt.wins - wpth.wins) / (wpt.battles - wpth.battles) * 100 dwin_count,
  wpt.wins / wpt.battles * 100 wp,
  wpt.wins / wpt.battles * 100 - wpth.wins / wpth.battles * 100 dwp
FROM wot_player_tank wpt
  JOIN wot_player wp ON wp.player_id = wpt.player_id
  JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
  JOIN wot_tank wt ON wt.tank_id = wpt.tank_id
  JOIN (SELECT
    pt.player_id,
    pt.tank_id,
    (SELECT
      MIN(pth.updated_at)
    FROM wot_player_tank_history pth
    WHERE pth.updated_at > DATE_ADD(pt.updated_at, INTERVAL -2 DAY)
    AND pth.player_id = pt.player_id
    AND pth.tank_id = pt.tank_id) last_updated_at
  FROM wot_player_tank pt) a ON a.player_id = wpt.player_id AND a.tank_id = wpt.tank_id
  JOIN wot_player_tank_history wpth ON wpth.player_id = a.player_id AND wpth.tank_id = a.tank_id AND wpth.updated_at = a.last_updated_at
WHERE wpt.updated_at > DATE_ADD(NOW(), INTERVAL -1 WEEK)
ORDER BY wpt.player_id, wpt.battles - wpth.battles DESC