SELECT wp.player_name, wt.tank_name_i18n, wpt.wins/wpt.battles*100 wp, wpt.battles FROM wot_player_tank wpt
  JOIN wot_player wp ON wpt.player_id = wp.player_id
  JOIN wot_player_clan wpc ON wp.player_id = wpc.player_id AND wpc.clan_id=:clan AND wpc.escape_date IS NULL 
  JOIN wot_tank wt ON wpt.tank_id = wt.tank_id AND wt.tank_level=10
WHERE wpt.wins/wpt.battles*100<50