<?php

namespace Inspector;

use Mvc\AbstractController;
use ArrayObject;
use ReflectionClass;

abstract class AbstractInspector implements InspectorInterface
{
	protected $pattern = "/@(.*)\n/";
	
	protected $object = null;

	protected $parse = null;

	public function __construct()
	{
		$this->parse = new ArrayObject();
	}

	abstract public function parse();

	abstract public function fill($DocComment, $method);
}