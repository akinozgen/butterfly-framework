<?php

    header('Content-type: text/plain; charset=utf-8');

    // Last slash deadly recommended!!!
    define(URL, 'http://butterfly.app/');

    require_once '../vendor/autoload.php';
    require_once '../core/Config/config.php';
    require_once '../core/System/UrlParser.php';
    require_once '../core/System/Route.php';
    require_once '../core/System/Parameters.php';

    use \Butterfly\System\UrlParser as Url;

    $url = new Url($config);