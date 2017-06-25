<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/3/17
 * Time: 11:07 PM
 */

namespace Butterfly\System;

use Butterfly\System\Exception;

class Root
{
    /**
     * @var UrlParser $url
     */
    private $url;
    /**
     * @var string
     */
    private $method;
    /**
     * @var Parameters
     */
    private $parameters;
    /**
     * @var Request
     */
    private $request;

    /**
     * Root constructor.
     * @param string $url
     * @param Parameters $parameters
     * @param Request $request
     */
    function __construct($url, $parameters, $request) {
        $this->url = $url;
        $this->parameters = $parameters;
        $this->request = $request;
    }

    /**
     * @param $config
     * @throws \Exception
     */
    public function runCalledMethod($config) {
        $route = $this->url->getRoute();

        $class = "\\Butterfly\\Bundles\\" .
                 "{$route->getBundle(true)}\\Controllers\\" .
                 "{$route->getController(true)}";

        $method = $route->getMethod(false);

        if ( ! $this->bundleExists($route->getBundle())) {
            throw new Exception(
                "002",
                [
                    'bundlename' => $route->getBundle()
                ]
            );
        } else if ( ! $this->controllerExists($route->getBundle(), $route->getController())) {
            throw new Exception(
                "003",
                [
                    'controller' => $route->getController()
                ]
            );
        }

        require_once __DIR__."/../../bundles/{$route->getBundle()}/Controllers/{$route->getController()}.php";

        if (method_exists($class, $method)) {
            // This place where magic appears and make world better.
            $this->method = new $class();
            $this->method->$method($this->parameters, $this->request);
            // Magic is done. Go blog...
        } else {
            throw new Exception(
                "004",
                [
                    'method' => $route->getMethod()
                ]
            );
        }
    }

    private function bundleExists($bundle_name) {
        return file_exists(__DIR__ . '/../../bundles/' . $bundle_name);
    }

    private function controllerExists($bundle_name, $controller_name) {
        return file_exists(__DIR__ . '/../../bundles/' . $bundle_name . '/Controllers/'. $controller_name .'.php');
    }

}