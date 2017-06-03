<?php

    header('Content-type: text/plain; charset=utf-8');

    // Last slash deadly recommended!!!
    define('URL', 'http://butterfly.app/');

    require_once '../vendor/autoload.php';
    require_once '../core/Config/config.php';
    require_once '../core/System/Exception.php';
    require_once '../core/System/UrlParser.php';
    require_once '../core/System/Route.php';
    require_once '../core/System/Parameters.php';
    require_once '../core/System/Root.php';
    require_once '../core/System/Request.php';

    use \Butterfly\System\UrlParser as Url;
    use \Butterfly\System\Root as Root;
    use \Butterfly\System\Exception as ButterflyException;

    $url  = new Url($config);
    $root = new Root($url, $url->getParameters(), $url->getRequest());

    try {
        $root->runCalledMethod($config);
    } catch (ButterflyException $exception) {
        echo $exception->getMessage();
        echo $exception->getErrorCode();
        die();
    }