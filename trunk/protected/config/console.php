<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

$config=require(dirname(__FILE__).'/common.php');

$config=CMap::mergeArray($config,array(
	'name'=>'My Console Application',
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'logFile'=>'console.log',
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'utf8'=>true,
					'subject'=>'MUMMI console error',
					'class'=>'CEmailLogRoute',
					'levels'=>'error',
					'emails'=>'borodulin@gmail.com',
					'except'=>'exception.CHttpException.*',
				),
			),
		),
	),
));

return $config;