<?php

class QWidget extends CWidget
{

	public function getFullFile()
	{
		$c = new ReflectionClass($this);
		return $c->getFileName();
	}

}