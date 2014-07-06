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
		$ts3 = TeamSpeak3::factory(Yii::app()->params['tsUri']);
		$clientList = $ts3->clientList();
		
		$memberGroup=$ts3->serverGroupGetByName('MUMMI');
		if(empty($memberGroup))
			throw new CException('member group is empty');
		$friendGroup=$ts3->serverGroupGetByName('Друг');
		if(empty($friendGroup))
			throw new CException('friend group is empty');
		
		foreach ($clientList as $client){
			if(((string)$client['client_platform'])!='ServerQuery'){
				$info =$client->getInfo();
				
				$clientGroups=array();
				foreach ($client->memberOf() as $clientGroup){
					$clientGroups[$clientGroup->getId()]=$clientGroup;
				}
				
				if(preg_match('/^\w+/', (string)$client, $matches)){
					$playerName=$matches[0];
					$player=WotPlayer::model()->with(array('playerClan'))->findByAttributes(array('player_name'=>$playerName));
					if(!empty($player)){
						if(empty($player->playerClan)){
							if(isset($clientGroups[$memberGroup->getId()]));{
								$client->addServerGroup($friendGroup->getId());
								$client->remServerGroup($memberGroup->getId());
							}
						}
						else
						{
							
							$sql="INSERT IGNORE INTO wot_teamspeak(updated_at, player_id, client_id)VALUES(now(),{$player->player_id}, {$info['client_database_id']})";
							Yii::app()->db->createCommand($sql)->execute();
						}
//						$wins=number_format($stat->wins/$stat->battles*100,2);
//						$description="\nПроцент побед: {$wins} \nWN8: {$player->wn8}\nРЭ: {$player->effect}\n";
//						$client->modifyDb(array('client_description'=>$description));
					}
					else
					{
						if(isset($clientGroups[$memberGroup->getId()]));{
							$client->addServerGroup($friendGroup->getId());
							$client->remServerGroup($memberGroup->getId());
						}
					}
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
	
	
	public function actionIvanner()
	{
		$url=new CUrlHelper();
		if($url->execute('http://ivanerr.ru/lt/showclansrating/')){
			$xpath=new XmlPath($url->content);
			$query=$xpath->queryAll(array(
				'ivanner_pos'		=> '//tr[td/a[@href="/lt/clan/'.WotClan::$clanId.'"]]/td[1]/b',
				'ivanner_strength'	=> '//tr[td/a[@href="/lt/clan/'.WotClan::$clanId.'"]]/td[5]/b',
				'ivanner_firepower'	=> '//tr[td/a[@href="/lt/clan/'.WotClan::$clanId.'"]]/td[6]',
				'ivanner_skill'		=> '//tr[td/a[@href="/lt/clan/'.WotClan::$clanId.'"]]/td[7]',
			));
			$clan=WotClan::currentClan();
			$clan->setAttributes($query,false);
			$clan->players_count = count($clan->players);
			$clan->save(false);
		}
		if($url->execute('http://armor.kiev.ua/wot/clan/'.WotClan::$clanId)){
			$xpath=new XmlPath($url->content);
			$query=$xpath->queryAll(array(
					'armor_gk_pos'		=> '//*[@id="main"]/div[4]/div[6]/table[1]//tr[1]/td[2]',
					'armor_gk_val'		=> '//*[@id="main"]/div[4]/div[6]/table[1]//tr[1]/td[1]',
					'armor_random_pos'	=> '//*[@id="main"]/div[4]/div[6]/table[1]//tr[2]/td[2]',
					'armor_random_val'	=> '//*[@id="main"]/div[4]/div[6]/table[1]//tr[2]/td[1]',
			));
			foreach ($query as $key=>$val){
				$query[$key]=strtr($val, array(','=>'.',' '=>''));
			}
			$clan=WotClan::currentClan();
			$clan->setAttributes($query,false);
			$clan->save(false);
		}
	}
}
