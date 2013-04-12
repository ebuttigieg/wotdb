<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

$config=require(dirname(__FILE__).'/common.php');

$config=CMap::mergeArray($config,array(
	'name'=>'[THE-P] Pirates',
		// preloading 'log' component
	'preload'=>array('log'),

//	'theme'=>'bootstrap',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'defaultController'=>'wot',

	'modules'=>array(
		'gii'=>array(
			'generatorPaths'=>array(
				'bootstrap.gii',
			),
		),
	),

	// application components
	'components'=>array(
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'loid' => array(
			'class' => 'ext.lightopenid.loid',
		),
		'eauth' => array(
			'class' => 'ext.eauth.EAuth',
			'popup' => true, // Use the popup window instead of redirecting.
			'services' => array( // You can change the providers and their classes.
				'wot' => array(
					'class' => 'ext.eauth.services.WotOpenIDService',
				),
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				 array(
				 		'class'=>'CWebLogRoute',
				 ),
*/
			),
		),
		'widgetFactory' => array(
			'class'=>'CWidgetFactory',
			'widgets' => array(
				'CBreadcrumbs' => array(
					'tagName'=>'ul',
					'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
					'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
					'separator'=>'<span class="divider">/</span>',
					'htmlOptions'=>array('class'=>'breadcrumb'),
				),
			),
		),
	),
));

return $config;