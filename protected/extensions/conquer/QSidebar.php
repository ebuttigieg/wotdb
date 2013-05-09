<?php

Yii::import('zii.widgets.CMenu');

class QSidebar extends CMenu
{
	public $submenuHtmlOptions = array('class'=>'sub');
	
	public $hasSubmenuCssClass = 'has-sub';
	
	public $hasSubmenulinkLabelWrapper = '<a href="{url}">{label}<span class="arrow"></span></a>';
	
	public $linkLabelWrapper = '<a href="{url}">{icon}<span class="title">{label}</span></a>';
	
	public $firstItemCssClass = 'start';
	
	protected function renderMenuRecursive($items)
	{
		$count=0;
		$n=count($items);
		foreach($items as $item)
		{
			$count++;
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
			if($item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!==null)
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!==null)
				$class[]=$this->lastItemCssClass;
			if($this->itemCssClass!==null)
				$class[]=$this->itemCssClass;
			if($this->hasSubmenuCssClass!==null)
				$class[]=$this->hasSubmenuCssClass;
			if($class!==array())
			{
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
	
			echo CHtml::openTag('li', $options);
	
			$menu=$this->renderMenuItem($item);
			if(isset($this->itemTemplate) || isset($item['template']))
			{
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			}
			else
				echo $menu;
	
			if(isset($item['items']) && count($item['items']))
			{
				echo "\n".CHtml::openTag('ul',isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions)."\n";
				$this->renderMenuRecursive($item['items']);
				echo CHtml::closeTag('ul')."\n";
			}
	
			echo CHtml::closeTag('li')."\n";
		}
	}
	
	protected function renderMenuItem($item)
	{
		if(isset($item['url']))
		{
			if(isset($item['items']) && count($item['items']))
			{
				return strtr($this->hasSubmenulinkLabelWrapper,array('{label}'=>$item['label'],'{url}'=>$item['url']));
			}
			else
			{
				$label=$this->linkLabelWrapper===null ? $item['label'] : strtr($this->linkLabelWrapper,array('{label}'=>$item['label'],'{url}'=>$item['url']));
				return CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
			}
		}
		else
			return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
	}
}