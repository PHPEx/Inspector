<?php

namespace Inspector\Controller;

class Route
{
	private $data = null;

	public function __construct($args){
		$this->data = json_decode(str_replace(array('(',')'),'',$args));
	}

	public function getMethod(){
		return $this->data->method;
	}

	public function getRoute(){
		return $this->data->name;
	}
}