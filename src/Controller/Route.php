<?php

namespace Inspector\Controller;

class Route {

    private $data = null;
    private $params = array();

    public function __construct($args) {
        $this->data = json_decode(str_replace(array('(', ')'), '', $args));
    }

    public function getMethod() {
        return $this->data->method;
    }

    public function getUri() {
        $uri = $_SERVER['REQUEST_URI'];
        preg_match_all("/[a-z0-9]+|:[a-z0-9]*|\[:[a-z0-9]*\]/", $uri, $uriResult);
        return array('uri' => $uri, 'match' => count($uriResult[0]), 'parts' => $uriResult[0]);
    }

    public function getRoute() {
        preg_match_all("/[a-z0-9]+|:[a-z0-9]*|\[:[a-z0-9]*\]/", $this->data->name, $route);
        $uri = $this->getUri();
        $countRoute = count($route[0]);
        if ($countRoute == $uri['match']) {
            $params = array_combine($route[0], $uri['parts']);
            array_walk($params, array($this, 'cleanParam'));
            return true;
        }
    }

    public function getParams() {
        return $this->params;
    }

    private function cleanParam($value, $key) {
        if (strpos($key, ':') > -1) {
            $this->params[str_replace(':', '', $key)] = $value;
        }
    }
}
