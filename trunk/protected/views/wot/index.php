<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
		<h2><i class="icon-th"></i> Grid 12</h2>
		<div class="box-icon">
		<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
		<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
		<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
		</div>
		</div>
		<div class="box-content">
		<div class="row-fluid">
		<div class="span4"><h6>span 4</h6></div>
		<div class="span4"><h6>span 4</h6></div>
		<div class="span4"><h6>span 4</h6></div>
		</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
	<div class="box span3">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> Grid 3</h2>
			<div class="box-icon">
				<!-- >a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a -->
			</div>
		</div>
		<!-- div class="box-content"-->
	<?php
		$this->widget('zii.widgets.grid.CGridView',array(
	//	'type'=>array('condensed','striped','bordered'),
		'dataProvider'=>new CArrayDataProvider(WotReport::newMembers(),array(
				'keyField'=>'player_id',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
					'header'=>'Ник',
					'name'=>'player_name',
				),
				array(
						'header'=>'Дата вступления',
						'name'=>'entry_date',
				),
				array(
						'header'=>'Должность',
						'name'=>'clan_role_name',
				),
		),
		'htmlOptions'=>array('class'=>'box-content'),
		'template'=>"{items}\n{pager}",
		'itemsCssClass'=>'table table-condensed',
));
		?>

		<!--  /div-->
	</div><!--/span-->
<div class="box span3">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 3</h2>
<div class="box-icon">
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->
<div class="box span3">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 3</h2>
<div class="box-icon">
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->
<div class="box span3">
<div class="box-header well" data-original-title>
<h2>Plain</h2>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->
</div><!--/row-->

<div class="row-fluid sortable">
<div class="box span6">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 6</h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->

<div class="box span6">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 6</h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->
</div><!--/row-->
<div class="row-fluid sortable">
<div class="box span4">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 4</h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->

<div class="box span4">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 4</h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->

<div class="box span4">
<div class="box-header well" data-original-title>
<h2><i class="icon-th"></i> Grid 4</h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="row-fluid">
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
<div class="span4"><h6>span 4</h6></div>
</div>
</div>
</div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
<div class="span12 well">
<div>
<h1>Box less area</h1>
<p>The flat boxes can be created using grids. But you can also use grids inside grids, which makes the layout 100% flexible!</p>
</div>
</div><!--/span-->
</div><!--/row-->

<div class="row-fluid show-grid">
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
<div class="span1">1</div>
</div>

<div class="row-fluid show-grid">
<div class="span4">4</div>
<div class="span4">4</div>
<div class="span4">4</div>
</div>

<div class="row-fluid show-grid">
<div class="span3">3</div>
<div class="span3">3</div>
<div class="span3">3</div>
<div class="span3">3</div>
</div>

<div class="row-fluid show-grid">
<div class="span4">4</div>
<div class="span8">8</div>
</div>

<div class="row-fluid show-grid">
<div class="span6">6</div>
<div class="span6">6</div>
</div>

<div class="row-fluid show-grid">
<div class="span12">12</div>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView',array(
		'type'=>array('condensed','striped','bordered'),
		'dataProvider'=>new CArrayDataProvider(WotReport::newMembers(),array(
				'keyField'=>'player_id',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'player_id',
		),
		'htmlOptions'=>array('class'=>'span4'),
		'template'=>"{items}\n{pager}",
));

/*
$this->widget('ext.jqgrid.JQGrid',
	array('options'=>array(
		'url'=> $this->createUrl('wot/jqgriddata'),
		'datatype'=>'local',
		'data'=>WotReport::report(),
		'colNames'=>array('Игрок', 'Боев', 'Танк', 'Начиная с','По','Всего боев','Побед','Процент побед'),
		'colModel'=>array(
			array('name'=>'player_name','index'=>'player_name','width'=>140,'align'=>'left'),
			array('name'=>'b','index'=>'b','width'=>50,'align'=>'right','summaryType'=>'sum','sorttype'=>'number'),
			array('name'=>'tank_localized_name','index'=>'tank_localized_name','width'=>100),
			array('name'=>'hupdated_at','index'=>'hupdated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
			array('name'=>'updated_at','index'=>'updated_at','width'=>90,'sorttype'=>'datetime', 'datefmt'=>'Y-m-d H:i','align'=>'right','formatter'=>'date','formatoptions'=>array('srcformat'=>'Y-m-d H:i:s','newformat'=>'d.m.Y H:i')),
			array('name'=>'battle_count','index'=>'battle_count','width'=>80,'align'=>'right','sorttype'=>'number'),
			array('name'=>'win_count','index'=>'win_count','width'=>60,'align'=>'right','sorttype'=>'number'),
			array('name'=>'wp','index'=>'wp','width'=>100, 'align'=>'right','sorttype'=>'number','formatter'=>'number'),
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
)));
*/