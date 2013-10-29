<?php

$this->widget('ext.jqgrid.JQGrid', 
	array('options'=>array(
		'datatype'=>'local',
		'data'=>RptReport::execute('bestAchievments'),
		'colNames'=>array('Игрок', 'Медаль', 'Достижение'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'name','index'=>'name','width'=>150,'align'=>'right'),
			array('name'=>'max_cnt','index'=>'max_cnt','width'=>80,'align'=>'right','sorttype'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'player_name',
		'sortorder'=>'asc',
		'height'=>'auto',
		'caption'=>'Достижения',
		'viewrecords'=> true,
)));
