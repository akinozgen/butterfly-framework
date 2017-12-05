<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/3/17
 * Time: 8:38 PM
 */

namespace Butterfly\System;

/**
 * Class Parameters
 * @package Butterfly\System
 */
class Parameters
{
    /**
     * @var array $parameters
     */
    private $parameters = [];
    /**
     * Parameters constructor.
     * @param string $uri
     * @param array $config
     * @param Route $route
     */
    public function __construct($uri, $config, $route) {
        $uri = str_replace(
            $route->getRoutekey() !== '/' ? $route->getRoutekey() : '',
            '', $uri
        );
        $uri = explode('/', ltrim($uri, '/'));
        $this->setParameters($uri);
    }

    /**
     * @param array $pairs
     */
    private function setParameters($pairs) {
        $counter = 0;
        $keys  = $values = [];
        foreach ($pairs as $value) {
            if ($counter % 2 == 0) $keys[] = $value;
            else $values[] = $value;
            $counter++;
        }

        if (strlen($pairs[0]) > 1) {
            for ($i = 0; $i < count($keys); $i++) {
                @$this->parameters[$keys[$i]] = $values[$i];
            }
        } else {
            $this->parameters = [];
        }
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addParameter($key, $value) {
        $this->parameters[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter($key) {
        return @$this->parameters[$key];
    }

}