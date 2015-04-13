<?php

namespace Inspector;

use ArrayObject;

abstract class AbstractInspector {

    protected $pattern = "/@(.*)\n/";
    protected $object = null;
    protected $parse = null;

    public function __construct() {
        $this->parse = new ArrayObject();
    }

    abstract public function parse();

    abstract public function fill($DocComment, $member);
}
