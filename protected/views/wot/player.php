<div class="row-fluid">
	<div class="span2">
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-reorder"></i>Игроки</h4>
				<span class="tools">
					<a href="javascript:;" class="icon-chevron-down"></a>
					<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
					<a href="javascript:;" class="icon-refresh"></a>
					<a href="javascript:;" class="icon-remove"></a>
				</span>
			</div>
			<div class="widget-body">
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
				'player_name',
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