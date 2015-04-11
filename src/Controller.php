<?php

namespace Inspector;

use Mvc\AbstractController;
use ReflectionClass;

class Controller extends AbstractInspector{

	public function parse(){
		$methods = $this->getObject()->getMethods();
		$countMethods = count($methods);
		for($i=0;$i<$countMethods;$i++){
            preg_match_all($this->pattern, $methods[$i]->getDocComment() , $result);
            isset($result[1][0]) && !empty($result[1][0]) ? $this->fill($result[1][0],$methods[$i]) : null;
		}
		return $this;
	}

	public function fill($DocComment, $method){
		list($class, $args) = explode(' ',$DocComment);
		$r = new ReflectionClass($class);
		$this->parse->append(array('action'=>"{$method->class}:{$method->name}",$class=>$r->newInstance($args)));

	}

	public function getParse(){
		return $this->parse;
	}

	public function setObject(AbstractController $controller){
		$this->object = new ReflectionClass($controller);
	}

	public function getObject()
	{
		return $this->object;
	}

}