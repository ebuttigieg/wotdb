<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
?>
<div class="row-fluid">
	<div class="span4">
		<!-- BEGIN SAMPLE TABLE widget-->
		<div class="widget">
			<div class="widget-title">
				<h4 style="white-space: nowrap;"><i class="icon-reorder"></i>Топ 5 по эффективности</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
	//	'type'=>array('condensed','striped','bordered'),
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5effect(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'effect',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
		</div>
	<!-- END SAMPLE TABLE widget-->
	</div>
	<div class="span4">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Топ 5 по урону</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5damage(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'dmg',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
		</div>
	</div>
	<div class="span4">
		<div class="widget widget-tabs">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Топ 5</h4>
			</div>
			
			
			<div class="widget-body">
				<div class="tabbable portlet-tabs">
					<ul class="nav nav-tabs">
						<li class=""><a href="#portlet_tab2" data-toggle="tab">По захвату</a></li>
						<li class=""><a href="#portlet_tab3" data-toggle="tab">По засвету</a></li>
						<li class="active"><a href="#portlet_tab1" data-toggle="tab">По защите</a></li>
					</ul>
					<div class="tab-content">
					<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5defense(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'defense',
		),
		'id'=>"portlet_tab1",
		'htmlOptions'=>array('class'=>'tab-pane active'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>

			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5capture(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'capture',
		),
		'id'=>'portlet_tab2',
		'htmlOptions'=>array('class'=>'tab-pane'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
			
						<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5spotted(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'spotted',
		),
		'id'=>'portlet_tab3',
		'htmlOptions'=>array('class'=>'tab-pane'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
			
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Новые игроки</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::newMembers(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'entry_date',
				'clan_role_name',
				'days',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>	
		</div>
	</div>
	<div class="span4">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Ушедшие игроки</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::escapedMembers(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'escape_date',
				'clan_role_name',
				'days',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>				
		</div>
	</div>
	<div class="span4">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Карьера</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::career(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'clan_history_date',
				'clan_role_name',
				'new_role',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<!-- BEGIN SAMPLE TABLE widget-->
		<div class="widget">
			<div class="widget-title">
				<h4 style="white-space: nowrap;"><i class="icon-reorder"></i>Топ 5 по эффективности</h4>
			</div>
			<?php 
$this->widget('zii.widgets.grid.CGridView',array(
	//	'type'=>array('condensed','striped','bordered'),
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::top5effect(),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				'player_name',
				'effect',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
		</div>
	<!-- END SAMPLE TABLE widget-->
	</div>
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