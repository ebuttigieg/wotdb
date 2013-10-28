SELECT
  wp.player_name,
  wp.effect
FROM wot_player wp
  JOIN wot_player_clan wpc ON wpc.player_id = wp.player_id AND wpc.escape_date IS NULL AND wpc.clan_id = :clan
ORDER BY wp.effect DESC
LIMIT 5