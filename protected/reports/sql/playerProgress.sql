SELECT
  wph.player_id,
  UNIX_TIMESTAMP(DATE(wph.updated_at)) dd,
  MAX(wph.effect) effect,
  MAX(wph.wn6) wn6,
  MAX(wpsh.wins / wpsh.battles * 100) wp
FROM wot_player_history wph
  JOIN wot_player_statistic_history wpsh ON wpsh.player_id = wph.player_id AND wpsh.statistic_id = :stat AND wph.updated_at = wpsh.updated_at
WHERE wph.player_id = :player AND wph.effect > 0 AND DATE(wph.updated_at) < CURDATE() AND DATE(wph.updated_at) > DATE_ADD(CURDATE(), INTERVAL -3 MONTH)
GROUP BY DATE(wph.updated_at),
         wph.player_id
UNION (SELECT
  wp.player_id,
  UNIX_TIMESTAMP(DATE(wp.updated_at)),
  wp.effect,
  wp.wn6,
  wps.wins / wps.battles * 100
FROM wot_player wp
JOIN wot_player_statistic wps ON wp.player_id = wps.player_id AND wps.statistic_id=:stat
WHERE wp.player_id = :player
ORDER BY wp.updated_at DESC LIMIT 1)
ORDER BY dd