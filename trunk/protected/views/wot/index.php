<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
$cs=Yii::app()->clientScript;
$cs->registerPackage('jquery-peity');
$cs->registerScriptFile('/scripts/index.js', CClientScript::POS_END);
$cs->registerScript($this->getId().'Index','Index.initPeityElements();', CClientScript::POS_READY);

function getProgressClass($value){
	if($value<30)
		return 'progress-bar-danger';
	if($value<40)
		return 'progress-bar-warning';
	if($value<60)
		return 'progress-bar-info';	
	return 'progress-bar-success';	
}

function getPietyClass($value){
	if($value>0) 
		return 'good';	
	if($value<0)
		return 'bad'; 
	return 'ok';
}

?>
<!-- BEGIN OVERVIEW STATISTIC BARS-->
<div class="row stats-overview-cont">
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<?php $inc=-1*WotClan::currentClan()->increment('ivanner_pos');?>
			<div class="display stat <?php if($inc>0) echo getPietyClass($inc) ?> huge">
				<span class="line-chart">
					<?php echo WotClan::currentClan()->historyValues('ivanner_pos'); ?>
				</span>
				<div class="percent">
					<?php echo ($inc>0)?'+'.$inc:$inc;?>
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Рейтинг клана (Ivanner)
				</div>
				<div class="numbers">
					 <?php echo WotClan::currentClan()->ivanner_pos; ?>
				</div>
			</div>
			<div class="progress">
				<span style="width: <?php echo (1-WotClan::currentClan()->ivanner_pos/400)*100 ?>%;" class="progress-bar <?php echo getProgressClass((1-WotClan::currentClan()->ivanner_pos/400)*100) ?>" aria-valuenow="<?php echo WotClan::currentClan()->ivanner_pos; ?>" aria-valuemin="0" aria-valuemax="400">
					<span class="sr-only">
						 <?php echo (1-WotClan::currentClan()->ivanner_pos/400)*100?>% Complete
					</span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<?php $inc=WotClan::currentClan()->increment('ivanner_strength');?>
			<div class="display stat <?php if($inc>0) echo getPietyClass($inc); ?> huge">
				<span class="line-chart">
					 <?php echo WotClan::currentClan()->historyValues('ivanner_strength'); ?>
				</span>
				<div class="percent">
					 <?php echo ($inc>0)?'+'.$inc:$inc;?>
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Сила клана (Ivanner)
				</div>
				<div class="numbers">
					 <?php echo WotClan::currentClan()->ivanner_strength; ?>
				</div>
			</div>
			<div class="progress">
				<span style="width: <?php echo WotClan::currentClan()->ivanner_strength/10; ?>%;" class="progress-bar <?php echo getProgressClass(WotClan::currentClan()->ivanner_strength/10)?>" aria-valuenow="<?php echo WotClan::currentClan()->ivanner_strength; ?>" aria-valuemin="0" aria-valuemax="1000">
					<span class="sr-only">
						 <?php echo WotClan::currentClan()->ivanner_strength/10; ?>% Complete
					</span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<?php $inc=WotClan::currentClan()->increment('ivanner_firepower');?>
			<div class="display stat <?php echo getPietyClass($inc); ?> huge">
				<span class="line-chart">
					<?php echo WotClan::currentClan()->historyValues('ivanner_firepower'); ?>
				</span>
				<div class="percent">
					 <?php echo ($inc>0)?'+'.$inc:$inc;?>
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Огневая мощь (Ivanner)
				</div>
				<div class="numbers">
					 <?php echo WotClan::currentClan()->ivanner_firepower; ?>
				</div>
				<div class="progress">
					<span style="width: <?php echo WotClan::currentClan()->ivanner_firepower; ?>%;" class="progress-bar <?php echo getProgressClass(WotClan::currentClan()->ivanner_firepower);?>" aria-valuenow="<?php echo WotClan::currentClan()->ivanner_firepower; ?>" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">
							 <?php echo WotClan::currentClan()->ivanner_firepower; ?>% Complete
						</span>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<?php $inc=WotClan::currentClan()->increment('ivanner_skill');?>
			<div class="display stat <?php getPietyClass($inc); ?> huge">
				<span class="bar-chart">
					<?php echo WotClan::currentClan()->historyValues('ivanner_skill'); ?>
				</span>
				<div class="percent">
					 <?php echo ($inc>0)?'+'.$inc:$inc;?>
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Скил (Ivanner)
				</div>
				<div class="numbers">
					 <?php echo WotClan::currentClan()->ivanner_skill; ?>
				</div>
				<div class="progress">
					<span style="width: <?php echo WotClan::currentClan()->ivanner_skill; ?>%;" class="progress-bar <?php echo getProgressClass(WotClan::currentClan()->ivanner_skill)?>" aria-valuenow="<?php echo WotClan::currentClan()->ivanner_skill; ?>" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">
							 <?php echo WotClan::currentClan()->ivanner_skill; ?>% Complete
						</span>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<?php $inc=WotClan::currentClan()->increment('players_count');?>
			<div class="display stat <?php echo getPietyClass($inc); ?> huge">
				<span class="line-chart">
					<?php echo WotClan::currentClan()->historyValues('players_count'); ?>
				</span>
				<div class="percent">
					<?php echo ($inc>0)?'+'.$inc:$inc;?>
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Кол-во игроков
				</div>
				<div class="numbers">
					 <?php echo WotClan::currentClan()->players_count; ?>
				</div>
				<div class="progress">
					<span style="width: <?php echo WotClan::currentClan()->players_count; ?>%;" class="progress-bar <?php echo getProgressClass(WotClan::currentClan()->players_count)?>" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">
							 <?php echo WotClan::currentClan()->players_count; ?>% Complete
						</span>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="stats-overview stat-block">
			<div class="display stat bad huge">
				<span class="line-chart">
					 1,7,9,11, 14, 12, 6, 7, 4, 2, 9, 8, 11, 12, 14, 12, 10
				</span>
				<div class="percent">
					 +15%
				</div>
			</div>
			<div class="details">
				<div class="title">
					 Stock
				</div>
				<div class="numbers">
					 2090
				</div>
				<div class="progress">
					<span style="width: 15%;" class="progress-bar progress-bar-success" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">
							 15% Complete
						</span>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">
</div>
<!-- END OVERVIEW STATISTIC BARS-->
<div class="row-fluid">
	<div class="col-md-4">
		<!-- BEGIN SAMPLE TABLE widget-->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Топ 5 по эффективности
				</div>
			</div>
			<div class="portlet-body">
			<?php
$this->widget('zii.widgets.grid.CGridView',array(
	//	'type'=>array('condensed','striped','bordered'),
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('top5effect'),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
				'effect',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
			</div>
		</div>
	<!-- END SAMPLE TABLE widget-->
	</div>
	<div class="col-md-4">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Топ 5 по урону
				</div>
			</div>
			<div class="portlet-body">
			<?php
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('top5damage'),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
				'dmg',
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="portlet portlet-tabs">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Топ 5
				</div>
			</div>
			<div class="portlet-body">
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
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('top5defense'),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
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
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('top5capture'),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
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
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('top5spotted'),array(
				'keyField'=>'player_name',
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
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
	<div class="col-md-4">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Новые игроки
				</div>
			</div>
			<div class="portlet-body">
			<?php
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('newMembers'),array(
				'keyField'=>'player_name',
				'pagination'=>false,
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
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
	</div>
	<div class="col-md-4">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Ушедшие игроки
				</div>
			</div>
			<div class="portlet-body">
			<?php
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('escapedMembers'),array(
				'keyField'=>'player_name',
				'pagination'=>false,
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
					'class'=>'CLinkColumn',
					'id'=>'player_name',
					'labelExpression'=>'$data["player_name"]',
					'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
					'linkHtmlOptions'=>array('target'=>'_blank'),
				),
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
	</div>
	<div class="col-md-4">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Карьера
				</div>
			</div>
			<div class="portlet-body">
			<?php
$this->widget('zii.widgets.grid.CGridView',array(
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(RptReport::execute('career'),array(
				'keyField'=>'player_name',
				'pagination'=>false,
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
						'header'=>'Имя',
						'class'=>'CLinkColumn',
						'id'=>'player_name',
						'labelExpression'=>'$data["player_name"]',
						'urlExpression'=>'"http://wot-news.com/index.php/stat/single/ru/".$data["player_name"]',
						'linkHtmlOptions'=>array('target'=>'_blank'),
				),
				array('name'=>'clan_history_date','header'=>'Дата'),
				array('name'=>'clan_role_name','header'=>'Был'),
				array('name'=>'new_role','header'=>'Стал'),
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
	//	'hideHeader'=>true,
));
			?>
			</div>
		</div>
	</div>
</div>


<?php

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