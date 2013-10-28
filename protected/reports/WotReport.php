<?php

class WotReport
{
	public static function getDefaultParams()
	{
		$userId= Yii::app()->user->id;
		return array(
			'clan'=>WotClan::$clanId,
			'player'=>Yii::app()->user->id,
		);
	} 
	
	public static function execute($reportName, $params=array())
	{
		$params=CMap::mergeArray(self::getDefaultParams(), $params);
		$fileName=file_exists(__DIR__.'/'.$reportName.'.sql');
		if($fileName){
			$sql=file_get_contents($filename);
			$cmd=Yii::app()->db->cache(3600)->createCommand($sql);
			$cmd->prepare();
			$values=array();
			foreach ($cmd->params as $key => $value) {
				$values[$key]=$params[$key];
			}
			$data=$cmd->queryAll(true, $values);
			return $data;
		}
	}
}