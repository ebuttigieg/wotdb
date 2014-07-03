SELECT wpt.player_id, SUM(wpt.wins)/SUM(wpt.battles)*100 , COUNT(wpt.tank_id) tanks, AVG(CASE WHEN wpt.battles>300 THEN 300 ELSE wpt.battles END) usefulness
  FROM wot_player_tank wpt
  JOIN wot_player_clan wpc ON wpc.player_id=wpt.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  JOIN wot_tank wt ON wt.tank_id=wpt.tank_id AND wt.tank_level=10
  GROUP BY wpt.player_id