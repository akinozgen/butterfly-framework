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
    private $method;
    /**
     * Root constructor.
     * @param UrlParser $url
     */
    function __construct($url) {
        $this->url = $url;
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

        if (method_exists($class, $method)) {

            $this->method = new $class();
            $this->method->$method();

        } else {

            if ( ! $this->bundleExists($route->getBundle())) {

                throw new Exception("002", ['bundlename' => $route->getBundle()]);

            } else if ( ! $this->controllerExists($route->getBundle(), $route->getController())) {

                throw new Exception("003", ['controller' => $route->getController()]);

            }
        }
    }

    private function bundleExists($bundle_name) {
        return file_exists(__DIR__ . '/../../bundles/' . $bundle_name);
    }

    private function controllerExists($bundle_name, $controller_name) {
        return file_exists(__DIR__ . '/../../bundles/' . $bundle_name . '/controllers/'. $controller_name .'/');
    }

}