<?php

class CronCommand extends CConsoleCommand
{
	public function actionScan()
	{
		WotService::scanClan(WotClan::$clanId);
	}

	public function actionIndex()
	{
		echo 'hellow!';
	}

	public function actionTsSync()
	{
		$sql=<<<SQLS
UPDATE teamspeak.clients c
  JOIN wot_player wp ON c.client_nickname like CONCAT(wp.player_name,'%')
  JOIN wot_player_clan wpc ON wp.player_id = wpc.player_id AND wpc.escape_date IS NULL AND wpc.clan_id=:clan
  SET c.player_id=wp.player_id
  WHERE c.player_id IS NULL
SQLS;
		Yii::app()->db->createCommand($sql)->execute(array('clan'=>WotClan::$clanId));

		$clientProperties=ClientProperties::model()->findAll(array(
				'select'=>'t.*,c.player_id',
				'join'=>'JOIN clients c ON c.client_id=t.id',
				'condition'=>"t.ident='client_description' AND c.player_id IS NOT NULL",
		));

		$sql=<<<SQL
UPDATE client_properties cp
  set cp.value=:value
  WHERE cp.id=:id AND cp.ident='client_description'
SQL;

		foreach ($clientProperties as $cp) {
			$wotPlayer=WotPlayer::model()->findByPk($cp->player_id);
			$wins=number_format($wotPlayer->wins/$wotPlayer->battles_count*100,2);
			$s="$wotPlayer->player_name\nWins: $wins%\nEffect: $wotPlayer->effect\nWN6: $wotPlayer->wn6";
			$s=mb_convert_encoding($s,'UTF8','CP1252');
		//	echo $s;
			$cp->dbConnection->createCommand($sql)->execute(array('id'=>$cp->id,'value'=>$s));
			//	break;
		}
	}

}