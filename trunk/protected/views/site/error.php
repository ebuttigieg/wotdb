<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);

Yii::app()->clientScript->registerCssFile('/css/pages/error.css');

?>
<div class="span12">
<?php if(strncmp($code,'4',1)==0): ?>
	<div class="row-fluid page-404">
		<div class="span5 number">
			404
		</div>
		<div class="span7 details">
			<h3>Opps, You're lost.</h3>
			<p>
				We can not find the page you're looking for.<br />
				Is there a typo in the url? Or try the search bar below.
			</p>
			<form action="#">
				<div class="input-append">
					<input class="m-wrap" size="16" type="text" placeholder="keyword..." /><button class="btn blue">Search</button>
				</div>
			</form>
		</div>
	</div>
<?php elseif(strncmp($code,'5',1)==0): ?>
	<div class="row-fluid page-500">
		<div class="span5 number">
			500
		</div>
		<div class="span7 details">
			<h3>Opps, Something went wrong.</h3>
			<p>
				We are fixing it!<br />
				Please come back in a while.<br />
			</p>
		</div>
	</div>
<?php else: ?>
	<div class="row-fluid page-404">
		<div class="span5 number">
			<?php echo $code;?>
		</div>
		<div class="span7 details">
			<h3>Opps, You're lost.</h3>
			<p>
				<?php echo CHtml::encode($message); ?>
			</p>
		</div>
	</div>
<?php endif;?>
</div>