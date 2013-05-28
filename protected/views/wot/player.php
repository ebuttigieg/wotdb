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
				<div class="scroller" data-height="700px">
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
					'urlExpression'=>'"javascript:chart(".$data["player_id"].",'."'".'".$data["player_name"]."'."'".')"',
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
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-user"></i><span id="user"></span></h4>
			</div>
			<div class="widget-body">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4><i class="icon-reorder"></i>Динамика эффективности</h4>
								<span class="tools">
									<a href="javascript:;" class="icon-refresh"></a>
								</span>
							</div>
							<div class="widget-body">
								<div id="chart_1" class="chart"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4><i class="icon-reorder"></i>Динамика процента побед</h4>
								<span class="tools">
									<a href="javascript:;" class="icon-refresh"></a>
								</span>
							</div>
							<div class="widget-body">
								<div id="chart_2" class="chart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$script=<<<SCRIPT
function chart(playerId,playerName){
	var s1=[],s2=[],s3=[];
	$.ajax({
		url: '/wot/playerdata',
		method: 'GET',
		dataType: 'json',
		data: {id:playerId},
		success: function(series){
			$.each(series,function(index,value){
				s1.push([value.dd*1000,value.effect]);
				s2.push([value.dd*1000,value.wn6]);
				s3.push([value.dd*1000,value.wp]);
			});
			$.plot($("#chart_1"),
				[{data: s1, label: "рейтинг Wot-News" }, { data: s2, label: "рейтинг WN6" }],
				{
					series: {
						lines: {
							show: true
						},
						points: {
							show: true
						}
					},
					xaxis: { mode: "time", timeformat: "%0d.%0m.%y"},
					grid: {
						backgroundColor: {
							colors: ["#fff", "#eee"]
						}
					},
					legend: {show: true,  position: "nw", backgroundOpacity:0}
				}
			);
			$.plot($("#chart_2"),
				[{data: s3, label: "% побед" }],
				{
					series: {
						lines: {
							show: true
						},
						points: {
							show: true
						}
					},
					xaxis: { mode: "time", timeformat: "%0d.%0m.%y"},
					grid: {
						backgroundColor: {
							colors: ["#fff", "#eee"]
						}
					},
					legend: {show: true,  position: "nw", backgroundOpacity:0}
				}
			);
			$('#user').text(playerName);
		}
	});
}
SCRIPT;
	$cs=Yii::app()->clientScript;
	$cs->registerScript(__CLASS__.$this->getId(), $script,CClientScript::POS_END);
?>

