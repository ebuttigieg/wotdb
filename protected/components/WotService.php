<?php
class WotService
{
/*
	static private $host='worldoftanks.ru';
	static private $clanUrlJson='/uc/clans/{clanId}/members/?type=table';
	static private $playerUrlJson="http://worldoftanks.ru/community/accounts/{playerId}/";
*/

	//https://gist.github.com/2724734

//	static private $wotApiClanUrl="http://worldoftanks.ru/community/clans/{clanId}/api/1.1/?source_token=WG-WoT_Assistant-1.2.2";
//	static private $wotApiPlayerUrl="http://worldoftanks.ru/community/accounts/{playerId}/api/1.7/?source_token=WG-WoT_Assistant-1.2.2";
	static private $wotApiClanUrl="http://api.worldoftanks.ru/2.0/clan/info/?application_id=171745d21f7f98fd8878771da1000a31&clan_id={clanId}";
	static private $wotApiPlayerUrl="http://api.worldoftanks.ru/2.0/account/info/?application_id=171745d21f7f98fd8878771da1000a31&account_id={playerId}";
	static private $wotApiPlayerTanks="http://api.worldoftanks.ru/2.0/account/tanks/?application_id=171745d21f7f98fd8878771da1000a31&account_id={playerId}";
	static private $wotApiTanks="http://api.worldoftanks.ru/2.0/encyclopedia/tanks/?application_id=171745d21f7f98fd8878771da1000a31";


	static private function tryContent($url)
	{
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$content=curl_exec($ch);
		if (curl_errno($ch)) {
			$content=false;
		}
		curl_close($ch);
		return $content;
	}

	static private function getContent($url)
	{
		$retryCnt=0;
		$result=self::tryContent($url);
		while(($result==false)&&($retryCnt<3)){
			$retryCnt++;
			sleep(3);
			$result=self::tryContent($url);
		}
		if($result==false){
			Yii::log('Ошибка получения статистики','error');
		}
		return $result;
	}

	
	static private function ajaxRequest($url)
	{
		$ch = curl_init();
		$timeout = 10;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Accept:application/json, text/javascript, */*",
			//	"Accept: text/html, */*",
				"User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36",
				"Connection: Keep-Alive",
				"X-Requested-With: XMLHttpRequest",
		));
		$data = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch) ;
		curl_close($ch);
		if($err == 0){
			return (json_decode(trim($data), true));
		}else{
			return array();
		}
	}
	

	static private function doRequestJSON($url)
	{
		$host=self::$host;
		$error = 0;
		$data = array();
        $request = "GET $url HTTP/1.0\r\n";
        $request.= "Accept: text/html, */*\r\n";
        $request.= "User-Agent: Mozilla/3.0 (compatible; easyhttp)\r\n";
        $request.= "X-Requested-With: XMLHttpRequest\r\n";
        $request.= "Host: $host\r\n";
        $request.= "Connection: Keep-Alive\r\n";
        $request.= "\r\n";
		$n = 0;
		while(!isset($fp)){
			$fp = fsockopen($host, 80, $errno, $errstr, 15);
			if($n == 3){
				break;
			}
			$n++;
		}
		if (!$fp)
		{
			return "$errstr ($errno)<br>\n";
		} else
		{
			stream_set_timeout($fp,20);
			$info = stream_get_meta_data($fp);
			fwrite($fp, $request);
			$page = '';
			while (!feof($fp) && (!$info['timed_out']))
			{
				$page .= fgets($fp, 4096);
				$info = stream_get_meta_data($fp);
			}
			fclose($fp);
			if ($info['timed_out']) {
				$error = 1; //Connection Timed Out
			}
		}
		if($error == 0){
			preg_match("/{\"request(.*?)success\"}/", $page, $matches);
			$data = (json_decode($matches[0], true));
		}
		else
			return $error;
		return $data;
	}

	/**
	 * 
	 * @param WotClan $clan
	 */
	static public function updateClanInfo($clan)
	{
		$jsonString= self::getContent(str_replace('{clanId}', $clan->clan_id, self::$wotApiClanUrl));
		if($jsonString!=false){
			$jsonData=json_decode($jsonString,true);
			if($jsonData['status']=='ok'){
				if(isset($jsonData['data'][$clan->clan_id])){
					$data=$jsonData['data'][$clan->clan_id];
					$clan->clan_descr=$data['description'];
					$clan->updated_at=date('Y-m-d H:i',$data['updated_at']);
					$clan->clan_name=$data['abbreviation'];
					$clan->clan_fullname=$data['name'];
					$clan->clan_descr_html=$data['description_html'];
					$clan->clan_created=date('Y-m-d', $data['created_at']);
					$clan->clan_ico=$data['emblems']['large'];
					$clan->clan_motto=$data['motto'];
					$clan->save(false);
					
					$members=$data['members'];
				//	foreach ($data['members'] as $member) {
				//		$members[$member['account_id']]=$member;
				//	}
				}
				
				

				$tran=Yii::app()->db->beginTransaction();

				$clanPlayers=$clan->playersRec;
				foreach ($clanPlayers as $playerId=>$clanPlayerRec){
					if(!isset($members[$playerId]))// Покинул клан
					{
						$clanPlayerRec->escape_date=new CDbExpression('now()');
						$clanPlayerRec->save(false);
						continue;
					}
					if($clanPlayerRec->clan_role_id!=$members[$playerId]['role']){
						$clanPlayerRec->clan_role=$members[$playerId]['role'];
						$clanPlayerRec->save(false);
					}
				}
				foreach ($members as $playerId=>$playerData){
					if(!isset($clanPlayers[$playerId])) //Новый член клана
					{
						$player=WotPlayer::model()->findByPk($playerId);
						if(empty($player)){
							$player=new WotPlayer();
							$player->player_id=$playerId;
							$player->player_name=$playerData['account_name'];
							$player->save(false);
						}
						$playerClan = WotPlayerClan::model()->findByPk(array('player_id'=>$playerId,'clan_id'=>$clan->clan_id,'entry_date'=>date('Y-m-d' ,$playerData['created_at'])));
						if(empty($playerClan)){
							$playerClan=new WotPlayerClan();
							$playerClan->clan_id=$clan->clan_id;
							$playerClan->player_id=$playerId;
							$playerClan->entry_date=date('Y-m-d' ,$playerData['created_at']);
							$playerClan->clan_role=$playerData['role'];
						}
						else
						{
							if(!empty($playerClan->escape_date))
								$playerClan->escape_date=null;
						}
						$playerClan->save(false);
					}
				}

				$tran->commit();
			}
			else
				Yii::log($jsonString,'error');
				//var_dump($jsonData);
		}
	}

	/**
	 * 
	 * @param WotPlayer $player
	 */
	static public function updatePlayerInfo($player)
	{
		$jsonString=self::getContent(str_replace('{playerId}', $player->player_id, self::$wotApiPlayerUrl));
		if($jsonString!=false){
			$jsonData=json_decode($jsonString,true);
			if($jsonData['status']=='ok'){

				$tran=Yii::app()->db->beginTransaction();
				$data=$jsonData['data'][$player->player_id];
				$achievments=$player->achievments;
				foreach ($data['achievements'] as $key=>$value){
					if($value>0){
						if(isset($achievments[$key])){
							$playerAchievment=$achievments[$key];
						}else{
							$achievment=WotAchievment::achievment($key);
							$playerAchievment=new WotPlayerAchievment();
							$playerAchievment->achievment_id=$achievment->achievment_id;
							$playerAchievment->player_id=$player->player_id;
							
						}
						if($playerAchievment->cnt!=$value){
							$playerAchievment->save(false);
						}
					}
				}
				foreach (array('all', 'clan', 'company') as $statName){
					$stat=$player->getStatistic($statName);
					$stat->attributes=$data['statistics'][$statName];
					$stat->save(false);
				}
				$player->max_xp=$data['statistics']['max_xp'];
				$player->updated_at=date('Y-m-d H:i',$data['updated_at']);
				$player->created_at=date('Y-m-d H:i',$data['created_at']);
				$player->player_name=$data['nickname'];			
				$player->save(false);

				$tran->commit();
			}
			else
				Yii::log($jsonString,'error');
			//	var_dump($jsonData);
		}
	}
	
	static public function updateTanks()
	{
		$jsonString=self::getContent(self::$wotApiTanks);
		if($jsonString!=false){
			$jsonData=json_decode($jsonString,true);
			if($jsonData['status']=='ok'){
				$tran=Yii::app()->db->beginTransaction();
				$tanks=WotTank::model()->findAll(array('index'=>'tank_id'));
				foreach ($jsonData['data'] as $data){
				//	$tank=WotTank::model()->findByPk($data['tank_id']);//Attributes(array('tank_name'=>$tankName));//
					if(!isset($tanks[$data['tank_id']])){
						$tank=new WotTank();
						$tank->tank_id=$data['tank_id'];
						$tank->tank_class_id=$data['type'];
						$tank->tank_nation_id=$data['nation'];
						$tank->tank_level=$data['level'];
						$tank->is_premium=$data['is_premium'];
						if (preg_match("/#(.*?):(.*)/",$data['name'],$mathes)){
							$tankName=$mathes[2];
						}
						else
							$tankName=$data['name'];
						$tank->tank_name=$tankName;
						$tank->tank_localized_name=$tankName;
						$tank->save(false);
					}
				}
				$tran->commit();
			}
		}
	}
	
	static public function updatePlayerTanks($player)
	{
		$jsonString=self::getContent(str_replace('{playerId}', $player->player_id, self::$wotApiPlayerTanks));
		if($jsonString!=false){
			$jsonData=json_decode($jsonString,true);
			if($jsonData['status']=='ok'){
				$tran=Yii::app()->db->beginTransaction();
				foreach ($jsonData['data'][$player->player_id] as $vehicle){
					$playerTank=WotPlayerTank::getPlayerTank($player->player_id, $vehicle['tank_id']);
					foreach (WotPlayerTank::$attrs as $attr) {
						$playerTank->$attr=$vehicle['statistics'][$attr];
					}
					$playerTank->updated_at=$player->updated_at;
					if($vehicle['last_battle_time']>0)
						$player->last_battle_time=date('Y-m-d H:i',$vehicle['last_battle_time']);
					$playerTank->mark_of_mastery=$vehicle['mark_of_mastery'];
					$playerTank->in_garage=$vehicle['in_garage'];
					$playerTank->save(false);
					foreach (array('all', 'clan', 'company') as $statName){
						$stat=$playerTank->getStatistic($statName);
						$stat->attributes=$vehicle['statistics'][$statName];
						$stat->save(false);
					}
				}
				$tran->commit();
			}
		}
	}

	static public function scanClan($clanId)
	{
		self::updateTanks();
		
		$clan=WotClan::model()->findByPk($clanId);
		if(empty($clan)){
			$clan=new WotClan();
			$clan->clan_id=$clanId;
		}
		self::updateClanInfo($clan);
//!!	self::updateClanPlayers($clan);
		$clan->refresh();
		foreach ($clan->players as $player){
			self::updatePlayerInfo($player);
			self::updatePlayerTanks($player);
			
		}
		WotPlayer::calcRating();
	}

	/**
	 * 
	 * @param WotClan $clan
	 */
	static public function updateClanPlayers($clan)
	{
		$data=self::doRequestJSON(str_replace('{clanId}', $clan->clan_id, self::$clanUrlJson));
		$items=$data['request_data']['items'];
		$players=array();
		foreach ($items as $playerData) {
			$players[$playerData['account_id']]=$playerData;
		}
		unset($data);
		$clanPlayers=$clan->players;
		foreach ($clanPlayers as $playerId=>$clanPlayer){
			if(!isset($players[$playerId]))// Покинул клан
			{
				$playerClan=WotPlayerClan::model()->findByAttributes(array('player_id'=>$playerId,'clan_id'=>$clan->clan_id,'escape_date'=>null));
				if(!empty($playerClan)){
					$playerClan->escape_date=new CDbExpression('now()');
					$playerClan->save(false);
				}
				continue;
			}
			if($clanPlayer->clan_role!=$players[$playerId]['role']){
				$clanPlayer->clan_role=$players[$playerId]['role'];
				$clanPlayer->save(false);
			}
		}
		foreach ($players as $playerId=>$playerData){
			if(!isset($clanPlayers[$playerId])) //Новый член клана
			{
				$player=WotPlayer::model()->findByPk($playerId);
				if(empty($player)){
					$player=new WotPlayer();
					$player->player_id=$playerId;
					$player->player_name=$playerData['name'];
					$player->save(false);
				}
				$playerClan=new WotPlayerClan();
				$playerClan->clan_id=$clan->clan_id;
				$playerClan->player_id=$playerId;
				$playerClan->entry_date=date('Y-m-d' ,$playerData['member_since']);
				$playerClan->clan_role=$playerData['role'];
				$playerClan->save(false);
			}
		}
	}
	
	/**
	 * 
	 * @param WotClan $clan
	 */
	static public function updateClanProvinces($clan)
	{
		$clanId=$clan->clan_id.'-'.$clan->clan_name;
		$data=self::ajaxRequest("http://worldoftanks.ru/community/clans/$clanId/provinces/list/");
		$currentProvinces=array();
		if(!empty($data)){
			if($data['result']=='success'){
				foreach ($data['request_data']['items'] as $item){
					$province=WotProvince::getByAttributes($item['name'], $item['id']);
					$map=WotMap::getByName($item['arena_name']);
					$currentProvinces[$item['name']]=$item['id'];
					$clanProvince=WotClanProvince::model()->findByAttributes(array(
						'province_id'=>$province->province_id,
						'clan_id'=>$clan->clan_id,
						'date_end'=>null,
					));
					if(empty($clanProvince)){
						$clanProvince=new WotClanProvince();
						$clanProvince->clan_id=$clan->clan_id;
						$clanProvince->province_id=$province->province_id;
						$clanProvince->prime_time=$item['prime_time'];
						$clanProvince->map_id=$map->map_id;
						$clanProvince->revenue=$item['revenue'];
						$clanProvince->type=$item['type'];
						$days=intval($item['occupancy_time']);
						if($days>0)
							$clanProvince->date_start=new CDbExpression("date_add(curdate(), interval -$days DAY)");
						else
							$clanProvince->date_start=new CDbExpression('curdate()');
						$clanProvince->save(false);
					}
				}
				foreach ($clan->clanProvinces as $clanProvince){
					if(!isset($currentProvinces[$clanProvince->province->province_name])){
						$clanProvince->date_end=new CDbExpression('now()');
						$clanProvince->save(false);
					}
				}
			}
		}
	}
	
}