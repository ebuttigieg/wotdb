<div class="row-fluid">
	<div class="span2">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Игроки</h4>
				<span class="tools">
					<a href="javascript:;" class="icon-refresh"></a>
				</span>
			</div>
			<div class="widget-body">
				<div class="scroller" data-height="690px">
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	//	'type'=>array('condensed','striped','bordered'),
		'itemsCssClass'=>'table table-condensed table-striped',
		'dataProvider'=>new CArrayDataProvider(WotReport::players(),array(
				'keyField'=>'player_name',
				'pagination'=>false,
		)),
	//	'filter'=>$model,
		'columns'=>array(
				array(
					'class'=>'CLinkColumn',
					'id'=>'player_name',
					'labelExpression'=>'$data["player_name"]',
				),
		),
		'htmlOptions'=>array('class'=>'widget-body'),
		'template'=>"{items}",
		'hideHeader'=>true,
));
?>
				</div>
			</div>
		</div>
	</div>
	<div class="span10">
		<div class="row-fluid">
			<div class="span6">
				<div class="widget">
					<div class="widget-title">
						<h4><i class="icon-reorder"></i>Basic Chart</h4>
						<span class="tools">
							<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
							<a href="javascript:;" class="icon-refresh"></a>
						</span>
					</div>
					<div class="widget-body">
						<div id="chart_1" class="chart"></div>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="widget">
					<div class="widget-title">
						<h4><i class="icon-reorder"></i>Basic Chart</h4>
						<span class="tools">
							<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
							<a href="javascript:;" class="icon-refresh"></a>
						</span>
					</div>
					<div class="widget-body">
						<div id="chart_2" class="chart"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="widget">
					<div class="widget-title">
						<h4><i class="icon-reorder"></i>Basic Chart</h4>
						<span class="tools">
							<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
							<a href="javascript:;" class="icon-refresh"></a>
						</span>
					</div>
					<div class="widget-body">
						<div id="chart_3" class="chart"></div>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="widget">
					<div class="widget-title">
						<h4><i class="icon-reorder"></i>Basic Chart</h4>
						<span class="tools">
							<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
							<a href="javascript:;" class="icon-refresh"></a>
						</span>
					</div>
					<div class="widget-body">
						<div id="chart_4" class="chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$script=<<<SCRIPT
var d1 = [];
for (var i = 0; i < Math.PI * 2; i += 0.25)
	d1.push([i, Math.sin(i)]);

var d2 = [];
for (var i = 0; i < Math.PI * 2; i += 0.25)
	d2.push([i, Math.cos(i)]);

var d3 = [];
for (var i = 0; i < Math.PI * 2; i += 0.1)
	d3.push([i, Math.tan(i)]);
$.plot($("#chart_1"), [{
		label: "sin(x)",
		data: d1
	}, {
		label: "cos(x)",
		data: d2
	}, {
		label: "tan(x)",
		data: d3
	}
	], {
		series: {
			lines: {
				show: true
			},
			points: {
				show: true
			}
		},
		xaxis: {
			ticks: [0, [Math.PI / 2, "\u03c0/2"],
					[Math.PI, "\u03c0"],
					[Math.PI * 3 / 2, "3\u03c0/2"],
					[Math.PI * 2, "2\u03c0"]
			]
		},
		yaxis: {
			ticks: 10,
			min: -2,
			max: 2
		},
		grid: {
			backgroundColor: {
				colors: ["#fff", "#eee"]
			}
		}
	}
);
SCRIPT;
	$cs=Yii::app()->clientScript;
	$cs->registerScript(__CLASS__.$this->getId(), $script,CClientScript::POS_READY);
?>

