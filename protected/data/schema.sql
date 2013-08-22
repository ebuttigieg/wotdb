
CREATE TABLE wot_achievment (
  achievment_id int(11) NOT NULL AUTO_INCREMENT,
  achievment_name varchar(100) NOT NULL,
  localized_name varchar(100) DEFAULT NULL,
  PRIMARY KEY (achievment_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_clan (
  clan_id int(11) NOT NULL,
  clan_name varchar(100) NOT NULL,
  updated_at datetime DEFAULT NULL,
  clan_fullname varchar(255) DEFAULT NULL,
  clan_created datetime DEFAULT NULL,
  clan_descr text DEFAULT NULL,
  clan_ico varchar(255) DEFAULT NULL,
  clan_motto text DEFAULT NULL,
  clan_descr_html text DEFAULT NULL,
  PRIMARY KEY (clan_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_clan_role (
  clan_role_id varchar(50) NOT NULL,
  clan_role_name varchar(50) NOT NULL,
  PRIMARY KEY (clan_role_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_map (
  map_id int(11) NOT NULL AUTO_INCREMENT,
  map_name varchar(50) NOT NULL,
  PRIMARY KEY (map_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player (
  player_id int(11) NOT NULL,
  player_name varchar(100) NOT NULL,
  created_at datetime NOT NULL,
  player_fio varchar(255) DEFAULT NULL,
  player_bitrh datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  spotted int(11) NOT NULL DEFAULT 0,
  hits_percents int(11) NOT NULL DEFAULT 0,
  capture_points int(11) NOT NULL DEFAULT 0,
  damage_dealt int(11) NOT NULL DEFAULT 0,
  frags int(11) NOT NULL DEFAULT 0,
  dropped_capture_points int(11) NOT NULL DEFAULT 0,
  wins int(11) NOT NULL DEFAULT 0,
  losses int(11) NOT NULL DEFAULT 0,
  battles_count int(11) NOT NULL DEFAULT 0,
  survived_battles int(11) NOT NULL DEFAULT 0,
  xp int(11) NOT NULL DEFAULT 0,
  battle_avg_xp int(11) NOT NULL DEFAULT 0,
  max_xp int(11) NOT NULL DEFAULT 0,
  effect decimal(10, 2) NOT NULL DEFAULT 0.00,
  wn6 decimal(10, 2) NOT NULL DEFAULT 0.00,
  achievements text DEFAULT NULL,
  PRIMARY KEY (player_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 5576
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_province (
  province_id int(11) NOT NULL AUTO_INCREMENT,
  province_name varchar(50) NOT NULL,
  territory_id varchar(10) NOT NULL,
  PRIMARY KEY (province_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_tank_class (
  tank_class_id varchar(50) NOT NULL,
  tank_class_name varchar(20) NOT NULL,
  PRIMARY KEY (tank_class_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_tank_nation (
  tank_nation_id varchar(50) NOT NULL,
  tank_nation_name varchar(50) NOT NULL,
  PRIMARY KEY (tank_nation_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_clan_battles (
  clan_id int(11) NOT NULL AUTO_INCREMENT,
  battle_time int(11) NOT NULL,
  province_id int(11) NOT NULL,
  map_id int(11) NOT NULL,
  PRIMARY KEY (clan_id, province_id),
  CONSTRAINT FK_wot_clan_battles_wot_clan_clan_id FOREIGN KEY (clan_id)
  REFERENCES wot_clan (clan_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_clan_battles_wot_map_map_id FOREIGN KEY (map_id)
  REFERENCES wot_map (map_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_clan_battles_wot_province_province_id FOREIGN KEY (province_id)
  REFERENCES wot_province (province_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_clan_province (
  clan_id int(11) NOT NULL,
  province_id int(11) NOT NULL,
  date_start datetime NOT NULL,
  date_end datetime DEFAULT NULL,
  map_id int(11) NOT NULL,
  revenue int(11) NOT NULL,
  prime_time int(11) NOT NULL,
  type enum ('normal', 'gold') NOT NULL,
  c_time datetime NOT NULL,
  PRIMARY KEY (clan_id, province_id, date_start),
  INDEX IDX_wot_clan_province_date_end (date_end),
  CONSTRAINT FK_wot_clan_province_wot_clan_clan_id FOREIGN KEY (clan_id)
  REFERENCES wot_clan (clan_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_clan_province_wot_map_map_id FOREIGN KEY (map_id)
  REFERENCES wot_map (map_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_clan_province_wot_province_province_id FOREIGN KEY (province_id)
  REFERENCES wot_province (province_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_achievment (
  player_id int(11) NOT NULL,
  achievment_id int(11) NOT NULL,
  cnt int(11) NOT NULL DEFAULT 0,
  updated_at datetime NOT NULL,
  PRIMARY KEY (player_id, achievment_id),
  CONSTRAINT FK_wot_player_achievment FOREIGN KEY (achievment_id)
  REFERENCES wot_achievment (achievment_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_wot_player_achievment_wot_player_player_id FOREIGN KEY (player_id)
  REFERENCES wot_player (player_id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_clan (
  entry_date date NOT NULL,
  player_id int(11) NOT NULL,
  clan_id int(11) NOT NULL,
  clan_role_id varchar(50) NOT NULL,
  escape_date date DEFAULT NULL,
  PRIMARY KEY (entry_date, player_id, clan_id),
  UNIQUE INDEX entry_date (entry_date, player_id, clan_id),
  CONSTRAINT FK_wot_player_clan_wot_clan_clan_id FOREIGN KEY (clan_id)
  REFERENCES wot_clan (clan_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_player_clan_wot_clan_role_clan_role_id FOREIGN KEY (clan_role_id)
  REFERENCES wot_clan_role (clan_role_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_wot_player_clan_wot_player_player_id FOREIGN KEY (player_id)
  REFERENCES wot_player (player_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 224
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_history (
  updated_at datetime NOT NULL,
  player_id int(11) NOT NULL,
  spotted int(11) NOT NULL DEFAULT 0,
  hits_percents int(11) NOT NULL DEFAULT 0,
  capture_points int(11) NOT NULL DEFAULT 0,
  damage_dealt int(11) NOT NULL DEFAULT 0,
  frags int(11) NOT NULL DEFAULT 0,
  dropped_capture_points int(11) NOT NULL DEFAULT 0,
  wins int(11) NOT NULL DEFAULT 0,
  losses int(11) NOT NULL DEFAULT 0,
  battles_count int(11) NOT NULL DEFAULT 0,
  survived_battles int(11) NOT NULL DEFAULT 0,
  xp int(11) NOT NULL DEFAULT 0,
  battle_avg_xp int(11) NOT NULL DEFAULT 0,
  max_xp int(11) NOT NULL DEFAULT 0,
  effect decimal(10, 2) NOT NULL DEFAULT 0.00,
  wn6 decimal(10, 2) NOT NULL DEFAULT 0.00,
  achievements text DEFAULT NULL,
  PRIMARY KEY (player_id, updated_at),
  CONSTRAINT FK_wot_player_history_wot_player_player_id FOREIGN KEY (player_id)
  REFERENCES wot_player (player_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 1890
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_tank (
  tank_id int(11) NOT NULL AUTO_INCREMENT,
  tank_class_id varchar(50) NOT NULL,
  tank_nation_id varchar(50) NOT NULL,
  tank_level int(11) NOT NULL,
  tank_name varchar(100) NOT NULL,
  tank_localized_name varchar(255) NOT NULL,
  tank_image varchar(255) DEFAULT NULL,
  PRIMARY KEY (tank_id),
  UNIQUE INDEX UK_wot_tank_tank_name (tank_name),
  CONSTRAINT FK_wot_tank_wot_tank_class_tank_class_id FOREIGN KEY (tank_class_id)
  REFERENCES wot_tank_class (tank_class_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_wot_tank_wot_tank_nation_tank_nation_id FOREIGN KEY (tank_nation_id)
  REFERENCES wot_tank_nation (tank_nation_id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 691
AVG_ROW_LENGTH = 344
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_teamspeak (
  updated_at datetime NOT NULL,
  player_id int(11) NOT NULL,
  client_id int(11) NOT NULL,
  PRIMARY KEY (updated_at, player_id),
  CONSTRAINT FK_wot_teamspeak_wot_player_player_id FOREIGN KEY (player_id)
  REFERENCES wot_player (player_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 163
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_clan_history (
  clan_history_date date NOT NULL,
  entry_date date NOT NULL,
  player_id int(11) NOT NULL,
  clan_id int(11) NOT NULL,
  clan_role_id varchar(50) NOT NULL,
  PRIMARY KEY (clan_history_date, player_id, clan_id, entry_date),
  CONSTRAINT FK_wot_player_clan_history FOREIGN KEY (entry_date, player_id, clan_id)
  REFERENCES wot_player_clan (entry_date, player_id, clan_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 62
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_tank (
  player_id int(11) NOT NULL,
  tank_id int(11) NOT NULL,
  updated_at datetime NOT NULL,
  battle_count int(11) NOT NULL DEFAULT 0,
  win_count int(11) NOT NULL DEFAULT 0,
  spotted int(11) NOT NULL DEFAULT 0,
  damageDealt int(11) NOT NULL DEFAULT 0,
  survivedBattles int(11) NOT NULL DEFAULT 0,
  frags int(11) NOT NULL DEFAULT 0,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id, tank_id),
  CONSTRAINT FK_wot_player_tank_wot_player_player_id FOREIGN KEY (player_id)
  REFERENCES wot_player (player_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_wot_player_tank_wot_tank_tank_id FOREIGN KEY (tank_id)
  REFERENCES wot_tank (tank_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 150
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE wot_player_tank_history (
  updated_at datetime NOT NULL,
  player_id int(11) NOT NULL,
  tank_id int(11) NOT NULL,
  battle_count int(11) NOT NULL DEFAULT 0,
  win_count int(11) NOT NULL DEFAULT 0,
  spotted int(11) NOT NULL DEFAULT 0,
  damageDealt int(11) NOT NULL DEFAULT 0,
  survivedBattles int(11) NOT NULL DEFAULT 0,
  frags int(11) NOT NULL DEFAULT 0,
  wn6 decimal(10, 2) NOT NULL DEFAULT 0.00,
  effect decimal(10, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (updated_at, player_id, tank_id),
  CONSTRAINT FK_wot_player_tank_history FOREIGN KEY (player_id, tank_id)
  REFERENCES wot_player_tank (player_id, tank_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 143
CHARACTER SET utf8
COLLATE utf8_general_ci;

DELIMITER $$

CREATE
DEFINER = 'root'@'localhost'
TRIGGER tr_wot_player_clan_update
AFTER UPDATE
ON wot_player_clan
FOR EACH ROW
BEGIN
  IF (old.clan_role_id <> new.clan_role_id) THEN
    INSERT INTO wot_player_clan_history (clan_history_date, entry_date, player_id, clan_id, clan_role_id)
      VALUES (NOW(), old.entry_date, old.player_id, old.clan_id, old.clan_role_id);
  END IF;
END
$$

CREATE
DEFINER = 'root'@'localhost'
TRIGGER tr_wot_player_tank_update
AFTER UPDATE
ON wot_player_tank
FOR EACH ROW
BEGIN
  IF (new.battle_count <> old.battle_count AND NOT EXISTS (SELECT
      *
    FROM wot_player_tank_history wpth
    WHERE wpth.updated_at = old.updated_at
    AND wpth.player_id = old.player_id
    AND wpth.tank_id = old.tank_id)) THEN
    INSERT INTO wot_player_tank_history (updated_at, player_id, tank_id, battle_count, win_count, spotted, damageDealt, survivedBattles, frags)
      (SELECT
        old.updated_at,
        old.player_id,
        old.tank_id,
        old.battle_count,
        old.win_count,
        old.spotted,
        old.damageDealt,
        old.survivedBattles,
        old.frags
      FROM wot_player wp
      WHERE wp.player_id = new.player_id);
  END IF;
END
$$

CREATE
DEFINER = 'root'@'localhost'
TRIGGER tr_wot_player_update
AFTER UPDATE
ON wot_player
FOR EACH ROW
BEGIN
  IF (new.battles_count <> old.battles_count AND old.updated_at IS NOT NULL AND NOT EXISTS (SELECT
      *
    FROM wot_player_history wph
    WHERE wph.player_id = new.player_id
    AND wph.updated_at = old.updated_at)) THEN
    INSERT INTO wot_player_history (updated_at, player_id, spotted, hits_percents, capture_points, damage_dealt, frags, dropped_capture_points, wins, losses, battles_count, survived_battles, xp, battle_avg_xp, max_xp, achievements, effect, wn6)
      VALUES (old.updated_at, old.player_id, old.spotted, old.hits_percents, old.capture_points, old.damage_dealt, old.frags, old.dropped_capture_points, old.wins, old.losses, old.battles_count, old.survived_battles, old.xp, old.battle_avg_xp, old.max_xp, old.achievements, old.effect, old.wn6);
  END IF;
END
$$

DELIMITER ;