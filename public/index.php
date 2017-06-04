<?php

    //region Meta Config
    header('Content-type: text/html; charset=utf-8');

    // Last slash deadly recommended!!!
    define('URL', 'http://butterfly.app/');
    //endregion
    //region Requires
    require_once '../vendor/autoload.php';
    require_once '../core/Config/config.php';
    require_once '../core/System/Exception.php';
    require_once '../core/System/UrlParser.php';
    require_once '../core/System/Route.php';
    require_once '../core/System/Parameters.php';
    require_once '../core/System/Root.php';
    require_once '../core/System/Request.php';
    //endregion
    //region Usings
    use \Butterfly\System\UrlParser as Url;
    use \Butterfly\System\Root as Root;
    use \Butterfly\System\Exception as ButterflyException;
    //endregion

    try {
        $url  = new Url($config);
        $root = new Root($url, $url->getParameters(), $url->getRequest());

        $root->runCalledMethod($config);
    } catch (ButterflyException $exception) {
        $now  = date('Y-m-d H:i:s');

        if ($config['defaults']->errors->show_error_codes)
            echo $exception->getErrorCode("<code>[{$now}][C:", "] ");

        if ($config['defaults']->errors->show_error_texts)
            echo $exception->getErrorMessage("", "</code>");

        die();
    }