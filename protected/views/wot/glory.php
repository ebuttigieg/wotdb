<?php

$cs = Yii::app()->clientScript;

$cellAttr=<<<FUNC
function jqcCellattr(rowId, val, rawObject, cm, rdata) {
	var v=rawObject[cm.name.substr(1)], val=rawObject[cm.name];
	if(val>0)
		return 'style="color:green" title="'+v+' (+'+ val +')"';
	else if(val<0)
		return 'style="color:red" title="'+v+' ('+ val +')"';
	else
		return 'title="'+val+'"';
}
FUNC;

$formatter=<<<FUNCF
function jqcFormatter(cellvalue, options, rowObject)
{
	if(cellvalue>0)
		cellvalue='+'+cellvalue;
	var v=rowObject[options.colModel.name.substr(1)];
	return parseFloat(v).toFixed(2) +'('+cellvalue+')';
}
function jqcFormatter1(cellvalue, options, rowObject)
{
	if(cellvalue>0)
		cellvalue='+'+cellvalue;
	var v=rowObject[options.colModel.name.substr(1)];
	return parseFloat(v).toFixed(0) +'('+cellvalue+')';
}
FUNCF;

	$cs->registerScript(__CLASS__. $this->getId().'1', $cellAttr, CClientScript::POS_READY);
	$cs->registerScript(__CLASS__. $this->getId().'2', $formatter, CClientScript::POS_READY);

$this->widget('ext.jqgrid.JQGrid', 
	array('options'=>array(
		'datatype'=>'local',
		'data'=>RptReport::execute('gloryPosition'),
		'colNames'=>array('Игрок', 'Дней в клане', 'Должность', 'Очки славы', 'Позиция'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'days','index'=>'days','width'=>100,'align'=>'right','sorttype'=>'number','firstsortorder'=>'desc'),
			array('name'=>'clan_role_name','index'=>'clan_role_name','width'=>150,'align'=>'right'),
			array('name'=>'glory_points','index'=>'glory_points','width'=>80,'align'=>'right','sorttype'=>'number','firstsortorder'=>'desc'), //'cellattr'=>'js:jqcCellattr','formatter'=>'js:jqcFormatter'
			array('name'=>'glory_position','index'=>'glory_position','width'=>80,'align'=>'right','sorttype'=>'number'),
		),
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'glory_points',
		'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Позиция славы',
		'viewrecords'=> true,
	),
	'theme'=>'conquer',
));
