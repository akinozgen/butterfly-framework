<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 3:10 PM
 */

namespace Butterfly\System;

/**
 * Class ActiveClass
 * @package Butterfly\System
 */
class ActiveClass
{
    private $twig;
    private $database;
    private $loader;
    private $path;
    private $sessions;

    /**
     * ActiveClass constructor.
     */
    function __construct()
    {
        global $config;
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem(__DIR__.'/../../views'), [
            'cache' => __DIR__.'/../../cache/twig',
            'auto_reload' => true
        ]);

        foreach ($config['defaults']->meta as $key => $value) {
            $this->twig->addGlobal($key, $config['defaults']->meta->$key);
        }

        $this->database = new Database($config['database']);
        $this->loader = new Loader();
        $this->path = new Path();
        $this->sessions = new Sessions($config['defaults']->session_key);
        $this->twig->addGlobal('Path', $this->path);
        $this->twig->addGlobal('Sessions', $this->sessions);
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig(): \Twig_Environment {
        return $this->twig;
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    /**
     * @return Loader
     */
    public function getLoader(): Loader
    {
        return $this->loader;
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return Sessions
     */
    public function getSessions()
    {
        return $this->sessions;
    }

}
