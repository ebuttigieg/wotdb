<?php

$this->widget('ext.jqgrid.JQGrid', 
	array('options'=>array(
		'datatype'=>'local',
		'data'=>RptReport::execute('medals'),
		'colNames'=>array('Игрок', 'Мед. Кариуса', 'Мед. Халонена', 'invader','Мед. Фадина','armorPiercer','Мед. Елькинса','Гроза мышей','mechanicEngineer','heroesOfRassenay','medalKay','defender','medalLeClerc'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'medalCarius','index'=>'medalCarius','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'medalHalonen','index'=>'medalHalonen','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'invader','index'=>'invader','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'medalFadin','index'=>'medalFadin','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'armorPiercer','index'=>'armorPiercer','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'medalEkins','index'=>'medalEkins','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'mousebane','index'=>'mousebane','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'mechanicEngineer','index'=>'mechanicEngineer','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'heroesOfRassenay','index'=>'heroesOfRassenay','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'medalKay','index'=>'medalKay','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'defender','index'=>'defender','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'medalLeClerc','index'=>'medalLeClerc','width'=>80,'align'=>'right','sorttype'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'player_name',
		'sortorder'=>'asc',
		'height'=>'auto',
		'caption'=>'Достижения',
		'viewrecords'=> true,
)));
