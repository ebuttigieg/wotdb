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
		'clientScript' => array(
		//	'scriptMap' => array(
		//		'jquery-ui.css' => '/css/ff/jquery-ui-1.9.1.custom.min.css',
		//		'jquery-ui.min.js' => '/css/ff/jquery-ui-1.9.2.custom.min.js',
		//		'jquery-ui-i18n.min.js' => '/css/ff/jquery-ui-i18n.min.js',
		//	),
			'packages' => array(
				'font-awesome'=>array(
						'basePath'=>'ext.conquer.font-awesome.assets',
					//	'js'=>array('modernizr.custom.js'),
						'css'=>array('css/font-awesome.min.css'),
					//	'depends'=>array(),
				),
				'scrollTo'=>array(
						'basePath'=>'ext.ScrollTo',
						'js'=>array('jquery.scrollTo-min.js'),
						'depends'=>array('jquery'),
				),
				'extJs'=>array(
						'basePath'=>'ext.ExtJs.assets',
						'js'=>array(YII_DEBUG?'ext-all-debug.js':'ext-all.js'),
						'css'=>array('resources/css/ext-all.css'),
				),
			),
		),
		'widgetFactory' => array(
			'class'=>'CWidgetFactory',
			'widgets' => array(
				'CBreadcrumbs' => array(
					'tagName'=>'ul',
					'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
					'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
					'separator'=>'<span class="icon-angle-right"></span>',
					'htmlOptions'=>array('class'=>'breadcrumb'),
				),
				'CMenu' => array(
					'submenuHtmlOptions'=>array('class'=>'sub'),
				//	'linkLabelWrapper'=>'<a href="{}">{}<span class="arrow open"></span></a>'
				),
			),
		),
	),
));

return $config;