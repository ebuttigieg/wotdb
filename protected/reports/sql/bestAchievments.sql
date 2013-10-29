SELECT
  wp.player_id,
  wp.player_name,
  wa.achievment_name,
  wa.name,
  wa.section,
  s.max_cnt
FROM wot_player_achievment wpa
  JOIN wot_player wp
    ON wpa.player_id = wp.player_id
  JOIN wot_achievment wa
    ON wpa.achievment_id = wa.achievment_id
  JOIN (SELECT
      a.achievment_id,
      MAX(max_cnt) max_cnt
    FROM wot_player_achievment wpa
      JOIN (SELECT
          wpa.achievment_id,
          MAX(wpa.cnt) max_cnt
        FROM wot_player_achievment wpa
        GROUP BY wpa.achievment_id) a
        ON a.achievment_id = wpa.achievment_id AND a.max_cnt = wpa.cnt
    GROUP BY a.achievment_id
    HAVING COUNT(*) = 1) s
    ON s.achievment_id = wpa.achievment_id AND s.max_cnt = wpa.cnt
ORDER BY wa.section, wp.player_name