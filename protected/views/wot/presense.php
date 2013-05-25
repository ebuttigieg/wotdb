<?php
$this->pageTitle=Yii::app()->name . ' - Посещаемость';
$this->breadcrumbs=array(
	'Посещаемость',
);
?>

<div class="row-fluid">
	<div class="span4">
<?php

$cs = Yii::app()->clientScript;

$cellAttr=<<<FUNC
function jqcCellattr(rowId, val, rawObject, cm, rdata) {
	if(val=='++')
		return 'style="background-color:#91cc8e" title="Был онлайн и в ТС"';
	if(val=='+')
		return 'style="background-color:#DADE64" title="Был онлайн"';
	else
		return 'style="background-color:#bd7187" title="Не играл"';
}
FUNC;

$formatter=<<<FUNCF
function jqcFormatter(cellvalue, options, rowObject)
{
	if(cellvalue==2)
		return '++';
	else if(cellvalue==1)
		return '+';
	else
		return '-';
}
FUNCF;

	$cs->registerScript(__CLASS__. $this->getId().'1', $cellAttr, CClientScript::POS_READY);
	$cs->registerScript(__CLASS__. $this->getId().'2', $formatter, CClientScript::POS_READY);


	$data=WotReport::playerPresense();
	$colModel=array(
		array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
	);
	$colNames=array('Игрок');
	foreach ($data['dates'] as $date){
		$colModel[]=array('name'=>$date,'index'=>$date,'width'=>75,'align'=>'right','sorttype'=>'number', 'cellattr'=>'js:jqcCellattr','formatter'=>'js:jqcFormatter');
		$colNames[]=$date;
	}

$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>$data['data'],
		'colNames'=>$colNames,
		'colModel'=>$colModel,
		'rowNum'=>1000,
	//	'rowList'=>array( 10, 20, 30 ),
		'sortname'=>'player_name',
	//	'sortorder'=>'desc',
		'height'=>'auto',
		'caption'=>'Посещаемость за 2 недели',
		'viewrecords'=> true,
	),
	'theme'=>'conquer',
));
?>
	</div>
</div>