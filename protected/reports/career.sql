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
WHERE wpch.clan_history_date > DATE_ADD(CURDATE(), INTERVAL -1 WEEK) AND wpch.clan_id = :clan
ORDER BY wpch.clan_history_date DESC