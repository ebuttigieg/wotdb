<?php

class CronCommand extends CConsoleCommand
{
	public function actionScan()
	{
		WotService::scanClan(WotClan::$clanId);
	}

	public function actionTanks()
	{
		WotService::updateTanks();
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
			$stat=$wotPlayer->getStatistic('all');
			if($stat->battles>0){
				$wins=number_format($stat->wins/$stat->battles*100,2);
				$s="$wotPlayer->player_name\nWins: $wins%\nEffect: $wotPlayer->effect\nWN6: $wotPlayer->wn6";
				$s=mb_convert_encoding($s,'UTF8','CP1252');
			//	echo $s;
				$cp->dbConnection->createCommand($sql)->execute(array('id'=>$cp->id,'value'=>$s));
			}
			//	break;
		}
	}

	public function actionPresense()
	{
		Yii::import('ext.teamspeak.libraries.TeamSpeak3.*',true);//cFsOcmiR
		// connect to local server, authenticate and spawn an object for the virtual server on port 9987
		$ts3_VirtualServer = TeamSpeak3::factory(Yii::app()->params['tsUri']);
		$arr_ClientList = $ts3_VirtualServer->clientList();
		$players=array();
		foreach ($arr_ClientList as $client){
			$info =$client->getInfo();
			$client=Clients::model()->findByPk($info['client_database_id']);
			if(!empty($client)){
				$player_id=$client->player_id;
				if(!empty($player_id)&&!isset($players[$player_id])){
					$players[$player_id]=true;
					$wts=new WotTeamspeak();
					$wts->updated_at=new CDbExpression('now()');
					$wts->player_id=$player_id;
					$wts->client_id=$info['client_database_id'];
					$wts->save(false);
				}
			}
		}
	}
	
	public function actionGk()
	{
		WotService::updateClanProvinces(WotClan::currentClan());
	}

	public function actionAchievments()
	{
		WotService::updateAchievments();
	}
	
}