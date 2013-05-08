<?php

Yii::import('zii.widgets.jui.CJuiWidget');

class JQGrid extends CJuiWidget
{
	private static $baseUrl;


	public $scriptFile=array('jquery.jqGrid.min.js','i18n/grid.locale-ru.js');

	public $cssFile=array('jquery-ui-custom.css','ui.jqgrid.css');

	protected function resolvePackagePath()
	{
		if(empty(self::$baseUrl)){
			self::$baseUrl=Yii::app()->assetManager->publish(dirname(__FILE__).'/assets');
		}
		if($this->scriptUrl===null || $this->themeUrl===null)
		{
			$cs=Yii::app()->getClientScript();
			if($this->scriptUrl===null)
				$this->scriptUrl=self::$baseUrl.'/js';
			if($this->themeUrl===null)
				$this->themeUrl=self::$baseUrl.'/themes';
		}
	}


	public function run()
	{
		$id=$this->getId();

		echo "<table id=\"{$id}\"></table><div id=\"{$id}_pager\"></div>";

		$this->options['pager']="#{$id}_pager";
		$options=CJavaScript::encode($this->options);

		$js = "jQuery('#{$id}').jqGrid($options);";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript(__CLASS__.'#'.$id, $js);
	}

}