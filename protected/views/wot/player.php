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
								<h4><i class="icon-reorder"></i>Динамика эффективности wot-news</h4>
								<span class="tools">
									<a href="javascript:;" class="icon-refresh"></a>
								</span>
							</div>
							<div class="widget-body">
								<div id="chart_1" class="chart" style="height: 200px"></div>
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
								<div id="chart_2" class="chart" style="height: 200px"></div>
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
var currentId;
function chart(playerId,playerName){
	currentId=playerId;
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
				[{data: s1, label: "рейтинг Wot-News" }, { data: s2, label: "рейтинг WN6" , yaxis: 2}],
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
					yaxes: [ { color: "#edc240"}, {position: 'right', color: "#afd8f8"} ],
					grid: {
						backgroundColor: {
							colors: ["#fff", "#eee"]
						},
						hoverable: true,
						clickable: true
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
						},
						hoverable: true,
						clickable: true
					},
					legend: {show: false,  position: "nw", backgroundOpacity:0}
				}
			);
			$('#user').text(playerName);
		}
	});
}
function showTooltip(x, y, contents) {
	$('<div id="tooltip">' + contents + '</div>').css( {
		position: 'absolute',
		display: 'none',
		top: y + 5,
		left: x + 5,
		border: '1px solid #fdd',
		padding: '2px',
		'background-color': '#fee',
		opacity: 0.80
	}).appendTo("body").fadeIn(200);
}
var previousPoint = null;
$("#chart_1,#chart_2").bind("plothover", function (event, pos, item) {
	$("#x").text(pos.x.toFixed(2));
	$("#y").text(pos.y.toFixed(2));

	if (item) {
		if (previousPoint != item.seriesIndex) {
			previousPoint = item.seriesIndex;

			$("#tooltip").remove();
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			showTooltip(item.pageX, item.pageY, item.series.label + " = " + y);
		}
	}
	else {
		$("#tooltip").remove();
		previousPoint = null;
	}
});

$("#chart_1,#chart_2").bind("plotclick", function (event, pos, item) {
	if (item) {
		var x = item.datapoint[0].toFixed(2)/1000;
		$("#tooltip").remove();
		$.ajax({
			url: '/wot/playertankdata',
			method: 'GET',
			dataType: 'json',
			data: {playerId:currentId,date:x},
			success: function(data){
				var content="";
				$.each(data,function(index,value){
					content=content+"<b>"+value.tank_localized_name+"</b> боев: "+value.bc+" побед: "+value.wc+"("+parseFloat(value.pw).toFixed(1)+"%)<br/>";
				});
				showTooltip(item.pageX, item.pageY, content);
			}
		});
	}
});
SCRIPT;
	$cs=Yii::app()->clientScript;
	$cs->registerScript(__CLASS__.$this->getId(), $script,CClientScript::POS_END);
?>

