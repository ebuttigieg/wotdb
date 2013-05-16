<?php
$this->pageTitle=Yii::app()->name . ' - Активность по танкам';
$this->breadcrumbs=array(
	'Активность по танкам',
);
?>

<div class="row-fluid">
	<div class="span4">
<?php

$cellAttr=<<<FUNC
js:function(rowId, val, rawObject, cm, rdata) {
	if(rawObject.dwp>0)
		return 'style="color:green" title="'+val+' (+'+ rawObject.dwp +')"';
	else if(rawObject.dwp<0)
		return 'style="color:red" title="'+val+' ('+ rawObject.dwp +')"';
	else
		return 'title="'+val+'"';
}
FUNC;

$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>WotReport::report(),
		'colNames'=>array('Игрок', 'Боев', 'Побед', 'Танк', 'Всего боев','Всего побед'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'b','index'=>'b','width'=>50,'align'=>'right','summaryType'=>'sum','sorttype'=>'number'),
			array('name'=>'dwin_count','index'=>'dwin_count','width'=>60,'align'=>'right','sorttype'=>'number','formatter'=>'number',),
			array('name'=>'tank_localized_name','index'=>'tank_localized_name','width'=>100),
		//	array('name'=>'hupdated_at','index'=>'hupdated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
		//	array('name'=>'updated_at','index'=>'updated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
			array('name'=>'battle_count','index'=>'battle_count','width'=>80,'align'=>'right','sorttype'=>'number'),
//			array('name'=>'win_count','index'=>'win_count','width'=>60,'align'=>'right','sorttype'=>'number'),
			array('name'=>'wp','index'=>'wp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'b',
		'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Статистика активных игроков',
		'viewrecords'=> true,
		'grouping'=>true,
		'groupingView'=> array(
			'groupField'=>array('player_name'),
			'groupColumnShow'=>array(true),
			'groupText'=> array('<b>{0}</b> Всего боев: {b}','{0} Sum of totaly: {b}'),
			'groupCollapse'=>true,
			'groupOrder'=>array('asc'),
		//	'groupSummary'=>array(false, false),
		),
	),
	'theme'=>'conquer',
));
?>
	</div>
</div>