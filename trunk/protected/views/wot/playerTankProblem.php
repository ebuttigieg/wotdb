<?php

$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		//'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>RptReport::execute('playerTankProblem'),
		'colNames'=>array('Игрок', 'Танк', 'Боев', 'Процент побед'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left','summaryType'=>'count'),
			array('name'=>'tank_name_i18n','index'=>'tank_name_i18n','width'=>100),
			array('name'=>'battles','index'=>'battles','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'wp','index'=>'wp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
	//	'sortname'=>'js:function(){console.log(this); return "cnt";}',
	//	'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Танки',
		'viewrecords'=> true,
		'grouping'=>true,
		'groupDataSorted'=>false,
		'groupingView'=> array(
			'groupField'=>array('player_name'),
			'groupColumnShow'=>array(true),
			'groupText'=> array('<b>{0}</b> Всего танков: {player_name}','{0} Sum of totaly: {b}'),
			'groupCollapse'=>true,
			'groupOrder'=>array('desc'),
			'groupSummary'=>array(false, false),
		),
	),
	'theme'=>'conquer',
));