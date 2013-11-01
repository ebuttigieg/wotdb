<?php

$cs = Yii::app()->clientScript;

$cellAttr=<<<FUNC
function jqcCellattr(rowId, val, rawObject, cm, rdata) {
	var vVal=rawObject[cm.index], title=cm.index, color="BEBEBE";
	if(vVal&1){
	    title=title+'\\nБыл онлайн';
	    color="D7E200";
	}
	if(vVal&2){
	    title=title+"\\nБыл в ТС";
	    color="5CCD00";
	}
	if(vVal&4){
	    title=title+"\\nВоевал на ГК";
	    color="9900FF";
	}
	return 'style="background-color:#'+color+'" title="'+title+'"';
}
FUNC;

$cs->registerScript(__CLASS__. $this->getId().'1', $cellAttr, CClientScript::POS_READY);

$this->widget('ext.jqgrid.JQGrid', 
	array('options'=>array(
		'datatype'=>'local',
		'data'=>RptReport::execute('bestAchievments'),
		'colNames'=>array('Игрок', 'Медаль', 'Достижение'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'name','index'=>'name','width'=>150,'align'=>'right', 'cellattr'=>'js:jqcCellattr'),
			array('name'=>'max_cnt','index'=>'max_cnt','width'=>80,'align'=>'right','sorttype'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'player_name',
		'sortorder'=>'asc',
		'height'=>'auto',
		'caption'=>'Достижения',
		'viewrecords'=> true,
	),
	'theme'=>'conquer',
));
