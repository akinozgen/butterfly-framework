<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/3/17
 * Time: 8:20 PM
 */

namespace Butterfly\System;


class Route
{
    /**
     * @var string $bundle
     */
    private $bundle;
    /**
     * @var string $controller
     */
    private $controller;
    /**
     * @var string $method
     */
    private $method;
    /**
     * @var string $route_key
     */
    private $route_key;
    /**
     * Route constructor.
     * @param string $route
     * @param array $config
     */
    function __construct($route_name) {
        global $config;
        $route = $this->route_name($route_name, $config);

        if ($route['status'] == 'not_found') {
            throw new Exception("017", [ 'route' => $route_name ]);
        }

        $split = explode( '/', $route['classpath'] );
        $this->route_key = $route['route'];

        $this->bundle     = $split[0] ? $split[0] : $config['defaults']->route->bundle;
        $this->controller = $split[1] ? $split[1] : $config['defaults']->route->controller;
        $this->method     = $split[2] ? $split[2] : $config['defaults']->route->method;
    }

    /**
     * @param string $route
     * @param array $config
     */
    private function route_name($route_path, $config) {
        foreach ($config['router'] as $route => $classpath) {
            if ($route == '/') {
                if ($route == $route_path)
                    return [
                        'status' => 'found',
                        'route' => $route,
                        'classpath' => $classpath
                    ];
            } else {
                if (preg_match_all("/".str_replace('/', '\/', $route)."/", $route_path)) {
                    return [
                        'status' => 'found',
                        'route' => $route,
                        'classpath' => $classpath
                    ];
                }
            }
        }
        return [
            'status' => 'not_found',
            'route' => $config['defaults']->route->name,
            'classpath' => $config['router'][$config['defaults']->route->name]
        ];
    }

    /**
     * @return string
     */
    public function getBundle($capitalize = false) {
        if ($capitalize) {
            return ucwords($this->bundle);
        } else {
            return $this->bundle;
        }
    }

    /**
     * @return string
     */
    public function getController($capitalize = false) {
        if ($capitalize) {
            return ucwords($this->controller);
        } else {
            return $this->controller;
        }
    }

    /**
     * @return string
     */
    public function getMethod($capitalize = false) {
        if ($capitalize) {
            return ucwords($this->method);
        } else {
            return $this->method;
        }
    }

    /**
     * @return string
     */
    public function getClassPath() {
        return $this->bundle . '/' . $this->controller . '/' . $this->method;
    }

    public function getRoutekey($trim_slashes = false) {
        if ($trim_slashes) {
            $route_key = ltrim($this->route_key, '/');
            $route_key = rtrim($route_key, '/');
            return $route_key;
        } else {
            return $this->route_key;
        }
    }
}