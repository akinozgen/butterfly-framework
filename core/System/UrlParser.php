<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/3/17
 * Time: 8:00 PM
 */

namespace Butterfly\System;

use Butterfly\System\Route as Router;

/**
 * Class UrlParser
 * @package Butterfly\System
 */
class UrlParser
{
    /**
     * @var mixed|string
     */
    private $uri;
    /**
     * @var Route
     */
    private $route;
    /**
     * @var Parameters
     */
    private $parameters;
    /**
     * @var Request
     */
    private $request;

    /**
     * UrlParser constructor.
     * @param array $config
     */
    function __construct($config) {
        $this->uri = rtrim("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '/');
        $this->uri = str_replace(['?', '=', ' ', '%20'], '', $this->uri);
        $this->uri = str_replace(rtrim(URL, '/'), '', $this->uri);
        $this->uri = (!$this->uri) ? '/' : $this->uri;

        $this->route = new Router($this->uri, $config);
        $this->parameters = new Parameters($this->uri, $config, $this->route);
        $this->request = new Request();
    }

    /**
     * @return Route
     */
    public function getRoute() {
        return $this->route;
    }

    /**
     * @return Parameters
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }
}