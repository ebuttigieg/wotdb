<div class="row-fluid">
	<div class="span4">
<?php
$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'datatype'=>'local',
		'data'=>WotReport::members(),
		'colNames'=>array('Игрок', 'Начал играть', 'Дней в клане', 'Должность','Обновлено'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'created_at','index'=>'created_at','width'=>100,'sorttype'=>'date','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y')),//d.m.Y H:i
			array('name'=>'dcnt','index'=>'dcnt','width'=>100,'align'=>'right','sorttype'=>'number','firstsortorder'=>'desc'),
		//	array('name'=>'wins','index'=>'wins','width'=>80,'align'=>'right','sorttype'=>'number'),
		//	array('name'=>'losses','index'=>'losses','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'clan_role_name','index'=>'clan_role_name','width'=>140,'align'=>'right', 'firstsortorder'=>'desc'),
		//	array('name'=>'battle_avg_xp','index'=>'battle_avg_xp','width'=>80,'align'=>'right','sorttype'=>'number','firstsortorder'=>'desc'),
		//	array('name'=>'max_xp','index'=>'max_xp','width'=>80,'align'=>'right','sorttype'=>'number','firstsortorder'=>'desc'),
		//	array('name'=>'effect','index'=>'effect','width'=>80,'align'=>'right','sorttype'=>'number','formatter'=>'number','firstsortorder'=>'desc'),
		//	array('name'=>'wn6','index'=>'wn6','width'=>80,'align'=>'right','sorttype'=>'number','formatter'=>'number','firstsortorder'=>'desc'),
			array('name'=>'updated_at','index'=>'updated_at','width'=>110,'align'=>'right','sorttype'=>'date','firstsortorder'=>'desc','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'dcnt',
		'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Игроки клана',
		'viewrecords'=> true,
	),
	'theme'=>'conquer',
));
?>
	</div>
</div>