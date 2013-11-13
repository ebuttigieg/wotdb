SELECT
  wp.player_name,
  wcr.clan_role_name,
  wcr1.clan_role_name new_role,
  h.clan_history_date
FROM (SELECT
  wpch.clan_history_date,
  wpch.player_id,
  wpch.clan_role_id,
  wpch.clan_id,
  wpch.entry_date,
  (SELECT
    w.clan_role_id
  FROM (SELECT
    wpch.clan_history_date,
    wpch.player_id,
    wpch.clan_id,
    wpch.clan_role_id,
    wpch.entry_date
  FROM wot_player_clan_history wpch
  UNION
  SELECT
    CURDATE() + 1 clan_history_date,
    wpc.player_id,
    wpc.clan_id,
    wpc.clan_role_id,
    wpc.entry_date
  FROM wot_player_clan wpc) w
  WHERE w.player_id = wpch.player_id AND w.clan_id = wpch.clan_id AND w.clan_history_date > wpch.clan_history_date AND w.entry_date = wpch.entry_date
  ORDER BY w.clan_history_date LIMIT 1) AS new_role_id
FROM wot_player_clan_history wpch
WHERE wpch.clan_history_date > DATE_ADD(CURDATE(), INTERVAL -1 WEEK) AND wpch.clan_id = :clan) h
  JOIN wot_clan_role wcr ON wcr.clan_role_id = h.clan_role_id
  JOIN wot_player wp ON wp.player_id = h.player_id
  JOIN wot_clan_role wcr1 ON wcr1.clan_role_id = h.new_role_id
ORDER BY h.clan_history_date DESC