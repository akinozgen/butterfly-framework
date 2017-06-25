<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 4:33 PM
 */

namespace Butterfly\System\Cli;

/**
 * Class Route
 * @var string $classpath
 * @var string $routepath
 * @var string $bundle
 * @var string $controller
 * @var string $method
 * @package Butterfly\System\Cli
 */
class Route
{
    private $classpath;
    private $routepath;
    private $bundle;
    private $controller;
    private $method;

    /**
     * Route constructor.
     * @param $route
     * @param $classpath
     * @param string $method
     */
    function __construct($route, $classpath, $method = 'main')
    {
        $this->parseClasspath($classpath);
        $this->routepath = substr($route, 0, 1) != '/' ? '/'.$route : $route;
    }

    /**
     * @return bool|int
     */
    public function createRoute() {
        global $config;
        $routes = $config['router'];
        $routes[$this->routepath] = $this->bundle.'/'.$this->controller.'/'.$this->method;
        $write = file_put_contents(
            __DIR__ . '/../../core/Config/router.json',
            str_replace("\\/", "/", json_encode($routes, JSON_PRETTY_PRINT))
        );

        return $write;
    }

    /**
     * @return bool|int
     */
    public static function removeRoute($routeKey) {
        global $config;
        $routes = $config['router'];
        unset($routes[substr($routeKey, 0, 1) != '/' ? '/'.$routeKey : $routeKey]);
        $write = file_put_contents(
            __DIR__ . '/../../core/Config/router.json',
            str_replace("\\/", "/", json_encode($routes, JSON_PRETTY_PRINT))
        );

        return $write;
    }

    /**
     * @return mixed
     */
    public function getClasspath()
    {
        return $this->classpath;
    }

    /**
     * @return mixed
     */
    public function getRoutepath()
    {
        return $this->routepath;
    }

    /**
     * @param string $path
     */
    private function parseClasspath($path) {
        if (strpos($path, '/') !== false) {
            $split = explode('/', $path);
            $this->classpath = "\\Butterfly\\Bundles\\".ucfirst($split[0])."\\Controllers\\".ucfirst($split[1]);
            $this->bundle = strtolower($split[0]);
            $this->controller = strtolower($split[1]);
            $this->method = strtolower($split[2]);
        } else {
            $split = explode("\\", $path);
            $this->bundle = strtolower($split[3]);
            $this->controller = strtolower($split[5]);
            $this->method = $split[6];
        }
    }

}