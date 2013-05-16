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
//	return 'title="'+rawObject.Name+' ('+ rawObject.Category+', '+rawObject.Subcategory+')"';
	var dv=rawObject['h'+cm.name];
	if(dv>0)
		return 'style="color:green" title="'+val+' (+'+ dv +')"';
	else if(dv<0)
		return 'style="color:red" title="'+val+' ('+ dv +')"';
	else
		return 'title="'+val+'"';
}
FUNC;

$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>WotReport::progress(),
		'colNames'=>array('Игрок', 'Боев', 'Эффективность', 'WN6', 'Побед','Опыт','Дамаг','Фраги','Засвет','Захват','Защита','Живучесть','Точность','Макс. опыт'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
//			array('name'=>'battles_count','index'=>'battles_count','width'=>50,'align'=>'right','summaryType'=>'sum','sorttype'=>'number'),
			array('name'=>'battles_count','index'=>'battles_count','width'=>80,'align'=>'right','sorttype'=>'number'),
//			array('name'=>'tank_localized_name','index'=>'tank_localized_name','width'=>100),
//			array('name'=>'hupdated_at','index'=>'hupdated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
//			array('name'=>'updated_at','index'=>'updated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
			array('name'=>'effect','index'=>'effect','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'wn6','index'=>'wn6','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'winp','index'=>'winp','width'=>80,'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'battle_avg_xp','index'=>'battle_avg_xp','width'=>60,'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'damage','index'=>'damage','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'frags','index'=>'frags','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'spotted','index'=>'spotted','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'cp','index'=>'cp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'dcp','index'=>'dcp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'sb','index'=>'sb','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'hitp','index'=>'hitp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
			array('name'=>'max_xp','index'=>'max_xp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number','cellattr'=>$cellAttr),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'b',
		'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Прогресс за последние 2 суток',
		'viewrecords'=> true,
	),
	'theme'=>'conquer',
));
?>
	</div>
</div>