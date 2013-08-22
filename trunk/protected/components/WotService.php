<?php
class WotService
{
/*
	static private $host='worldoftanks.ru';
	static private $clanUrlJson='/uc/clans/{clanId}/members/?type=table';
	static private $playerUrlJson="http://worldoftanks.ru/community/accounts/{playerId}/";
*/

	//https://gist.github.com/2724734

	static private $wotApiClanUrl="http://worldoftanks.ru/community/clans/{clanId}/api/1.1/?source_token=WG-WoT_Assistant-1.2.2";
	static private $wotApiPlayerUrl="http://worldoftanks.ru/community/accounts/{playerId}/api/1.7/?source_token=WG-WoT_Assistant-1.2.2";


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
				$clan->clan_descr=$jsonData['data']['description'];
				$clan->updated_at=date('Y-m-d H:i',$jsonData['data']['updated_at']);
				$clan->clan_name=$jsonData['data']['abbreviation'];
				$clan->clan_fullname=$jsonData['data']['name'];
				$clan->clan_descr_html=$jsonData['data']['description_html'];
				$clan->clan_created=date('Y-m-d', $jsonData['data']['created_at']);
				$clan->clan_ico=$jsonData['data']['emblems']['large'];
				$clan->clan_motto=$jsonData['data']['motto'];
				$clan->save(false);

				$members=array();
				foreach ($jsonData['data']['members'] as $member) {
					$members[$member['account_id']]=$member;
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

				$player->achievements=serialize($jsonData['data']['achievements']);
				$player->attributes=$jsonData['data']['battles'];
				$player->attributes=$jsonData['data']['summary'];
				$player->attributes=$jsonData['data']['experience'];
				$player->updated_at=date('Y-m-d H:i',$jsonData['data']['updated_at']);
				$player->created_at=date('Y-m-d H:i',$jsonData['data']['created_at']);
				$player->player_name=$jsonData['data']['name'];

				foreach ($jsonData['data']['vehicles'] as $vehicle){
					$tank=WotTank::getTank($vehicle['name'],$vehicle['localized_name'],$vehicle['level'],$vehicle['nation'],$vehicle['class'],$vehicle['image_url']);
					$playerTank=WotPlayerTank::getPlayerTank($player->player_id, $tank->tank_id);
					foreach (WotPlayerTank::$attrs as $attr) {
						$playerTank->$attr=$vehicle[$attr];
					}
					$playerTank->updated_at=$player->updated_at;
					$playerTank->save(false);
				}
				$player->save(false);

				$tran->commit();
			}
			else
				Yii::log($jsonString,'error');
			//	var_dump($jsonData);
		}
	}

	static public function scanClan($clanId)
	{
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
					if(!isset($currentProvinces[$clanProvince->province->name])){
						$clanProvince->date_end=new CDbExpression('now()');
						$clanProvince->save(false);
					}
				}
			}
		}
	}
	
}