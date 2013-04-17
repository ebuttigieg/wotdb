<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
?>
<div class="row-fluid">
	<div class="span3">
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
	<div class="span3">
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
	<div class="span3">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Топ 5 по засвету</h4>
			</div>
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
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
			?>
		</div>
	</div>
	<div class="span3">
		<div class="widget widget-tabs">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Топ 5</h4>
			</div>
			
			
			<div class="widget-body">
				<div class="tabbable portlet-tabs">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#portlet_tab1" data-toggle="tab">По защите</a></li>
						<li class=""><a href="#portlet_tab2" data-toggle="tab">По захвату</a></li>
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
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
            <div class="row-fluid">
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Striped Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
               <div class="span6">
                  <!-- BEGIN CONDENSED TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Condensed Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-condensed table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th class="hidden-phone">Username</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td>Mark</td>
                                 <td>Otto</td>
                                 <td class="hidden-phone">makr124</td>
                                 <td><span class="label label-success">Approved</span></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>Jacob</td>
                                 <td>Nilson</td>
                                 <td class="hidden-phone">jac123</td>
                                 <td><span class="label label-info">Pending</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Larry</td>
                                 <td>Cooper</td>
                                 <td class="hidden-phone">lar</td>
                                 <td><span class="label label-warning">Suspended</span></td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                              <tr>
                                 <td>4</td>
                                 <td>Sandy</td>
                                 <td>Lim</td>
                                 <td class="hidden-phone">sanlim</td>
                                 <td><span class="label label-danger">Blocked</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END CONDENSED TABLE widget-->
               </div>
            </div>
            <div class="row-fluid">
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-cogs"></i>Advance Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                           <thead>
                              <tr>
                                 <th><i class="icon-briefcase"></i> Company</th>
                                 <th class="hidden-phone"><i class="icon-user"></i> Contact</th>
                                 <th><i class="icon-shopping-cart"></i> Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="highlight">
                                    <div class="success"></div>
                                    <a href="#">RedBull</a>
                                 </td>
                                 <td class="hidden-phone">Mike Nilson</td>
                                 <td>2560.60$</td>
                                 <td><a href="#" class="btn mini purple"><i class="icon-edit"></i> Edit</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="info"></div>
                                    <a href="#">Google</a>
                                 </td>
                                 <td class="hidden-phone">Adam Larson</td>
                                 <td>560.60$</td>
                                 <td><a href="#" class="btn mini black"><i class="icon-trash"></i> Delete</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="important"></div>
                                    <a href="#">Apple</a>
                                 </td>
                                 <td class="hidden-phone">Daniel Kim</td>
                                 <td>3460.60$</td>
                                 <td><a href="#" class="btn mini purple"><i class="icon-edit"></i> Edit</a></td>
                              </tr>
                              <tr>
                                 <td class="highlight">
                                    <div class="warning"></div>
                                    <a href="#">Microsoft</a>
                                 </td>
                                 <td class="hidden-phone">Nick </td>
                                 <td>2560.60$</td>
                                 <td><a href="#" class="btn mini blue"><i class="icon-share"></i> Share</a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- END SAMPLE TABLE widget-->
               </div>
               <div class="span6">
                  <!-- BEGIN SAMPLE TABLE widget-->
                  <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-cogs"></i>Advance Table</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                        <a href="javascript:;" class="icon-refresh"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                     </div>
                     <div class="widget-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                           <thead>
                              <tr>
                                 <th><i class="icon-briefcase"></i> From</th>
                                 <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                 <th><i class="icon-bookmark"></i> Total</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><a href="#">Pixel Ltd</a></td>
                                 <td class="hidden-phone">Server hardware purchase</td>
                                 <td>52560.10$ <span class="label label-success label-mini">Paid</span></td>
                                 <td><a href="#" class="btn mini green-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    Smart House
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Office furniture purchase</td>
                                 <td>5760.00$ <span class="label label-warning label-mini">Pending</span></td>
                                 <td><a href="#" class="btn mini blue-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    FoodMaster Ltd
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Company Anual Dinner Catering</td>
                                 <td>12400.00$ <span class="label label-success label-mini">Paid</span></td>
                                 <td><a href="#" class="btn mini blue-stripe">View</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#">
                                    WaterPure Ltd
                                    </a>
                                 </td>
                                 <td class="hidden-phone">Payment for Jan 2013</td>
                                 <td>610.50$ <span class="label label-danger label-mini">Overdue</span></td>
                                 <td><a href="#" class="btn mini red-stripe">View</a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
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