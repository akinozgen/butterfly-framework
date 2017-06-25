<?php
/**
 * Created by PhpStorm.
 * User: Akın Özgen
 * Date: 20.06.2017
 * Time: 13:12
 */

namespace Butterfly\System;

class Path
{

    function __construct()
    {
    }

    public function asset($uri) {
        $assetUrl = URL . 'public/' . rtrim(ltrim($uri, '/'), '/');
        $assetPath = realpath(__DIR__ . '/../../public/'.$uri);

        if ($assetPath) {
            return $assetUrl;
        } else {
            throw new Exception('022', [ 'asset' => $uri ]);
        }
    }

    public function css($uri) {
        return $this->asset('css/' . rtrim(ltrim($uri, '/'), '/'));
    }

    public function js($uri) {
        return $this->asset('js/' . rtrim(ltrim($uri, '/'), '/'));
    }

    public function route($route_key) {
        global $config;
        $route = new Route($route_key);
        if ($route) {

            return URL . $route->getRoutekey(true);

        } else {
            throw new Exception('017', [ 'route' => $route_key ]);
        }
    }

    public function redirect_route($route_key) {
        header('Location: ' . $this->route($route_key));
    }

}