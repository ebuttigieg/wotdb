SELECT
  wp.player_id,
  wp.player_name,
  wcr.clan_role_name,
  a.updated_at AS dte,
  b.dts,
  a.ab,
  a.gb
FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
  JOIN wot_clan_role wcr ON wpc.clan_role_id = wcr.clan_role_id
  LEFT JOIN (SELECT
    a.player_id,
    a.updated_at,
    COUNT(a.b_all) ab,
    COUNT(a.b_gk) gb,
    COUNT(a.b_cm)
  FROM (SELECT
    s.player_id,
    s.statistic_id,
    DATE(s.updated_at) updated_at,
    MIN(s.battles),
    CASE s.statistic_id
      WHEN 1 THEN 1 ELSE NULL
    END b_all,
    CASE s.statistic_id
      WHEN 2 THEN 1 ELSE NULL
    END b_gk,
    CASE s.statistic_id
      WHEN 3 THEN 1 ELSE NULL
    END b_cm
  FROM (
  SELECT
    wpsh.player_id,
    wpsh.statistic_id,
    wpsh.updated_at,
    wpsh.battles
  FROM wot_player_statistic_history wpsh) s
  GROUP BY s.player_id,
           s.statistic_id,
           DATE(s.updated_at)) a
  GROUP BY a.player_id,
           a.updated_at) a ON a.player_id = wp.player_id
  LEFT JOIN (SELECT
    wpt.player_id,
    DATE(wp.updated_at) dts
  FROM wot_player_ts wpt
  JOIN wot_presense wp ON wp.ts_id=wpt.ts_id
  WHERE TIME(wp.updated_at) BETWEEN TIME('20:00') AND TIME('24:00')
  GROUP BY wpt.player_id,
           DATE(wp.updated_at)) b ON a.player_id = b.player_id AND a.updated_at = b.dts