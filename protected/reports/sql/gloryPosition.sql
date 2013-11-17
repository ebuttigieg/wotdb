SELECT
  wp.player_name,
  wpc.entry_date,
  wcr.clan_role_name,
  wpg.glory_points,
  IFNULL(NULLIF(wpg.glory_position,0), POWER(2,31)) glory_position
FROM wot_player wp
  JOIN wot_player_clan wpc ON wp.player_id = wpc.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
  JOIN wot_clan_role wcr ON wpc.clan_role_id = wcr.clan_role_id
  JOIN (SELECT
    MAX(wpg.updated_at) updated_at
  FROM wot_player_glory wpg) mup
  JOIN wot_player_glory wpg ON wp.player_id = wpg.player_id AND wpg.updated_at = mup.updated_at