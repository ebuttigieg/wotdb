<?php

$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>WotReport::tanks(),
		'colNames'=>array('Танк', 'Игрок', 'Боев', 'Побед', 'Процент побед'),
		'colModel'=>array(
			array('name'=>'tank_localized_name','index'=>'tank_localized_name','width'=>100),
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left','summaryType'=>'count'),
			array('name'=>'battle_count','index'=>'battle_count','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'win_count','index'=>'win_count','width'=>60,'align'=>'right','sorttype'=>'number'),
			array('name'=>'wp','index'=>'wp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'wp',
		'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Танки',
		'viewrecords'=> true,
		'grouping'=>true,
		'groupingView'=> array(
			'groupField'=>array('tank_localized_name'),
			'groupColumnShow'=>array(true),
			'groupText'=> array('<b>{0}</b> Всего танков: {player_name}','{0} Sum of totaly: {b}'),
			'groupCollapse'=>true,
			'groupOrder'=>array('asc'),
		//	'groupSummary'=>array(false, false),
		),
	),
	'theme'=>'conquer',
));
