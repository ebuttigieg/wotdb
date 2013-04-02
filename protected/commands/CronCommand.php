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

}