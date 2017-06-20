<?php
/**
 * Created by PhpStorm.
 * User: Akın Özgen
 * Date: 20.06.2017
 * Time: 12:24
 */

namespace Butterfly\System;


class Loader
{

    function __construct()
    {
    }

    /**
     * @param string $classpath \Butterfly\Bundles\[BundleName]\Models\[ModelName]
     * @throws Exception
     */
    public function loadModel($classpath) {
        // Ex.Classpath: \Butterfly\Bundles\[BundleName]\Models\[ModelName]
        $split = explode("\\", $classpath);
        $bundleName = strtolower($split[3]);
        $modelName = strtolower($split[5]);

        $filePath = realpath(__DIR__ . '/../../bundles/' . $bundleName . '/Models/' . $modelName . '.php');
        if ($filePath) {
            require_once $filePath;
        } else {
            throw new Exception('020', [ 'model' => $classpath ]);
        }
    }

    /**
     * @param string $classpath Ex.\Butterfly\Bundles\[BundleName]\Helpers\[HelperName]
     */
    public function loadHelper($classpath) {
        // Ex.Classpath: \Butterfly\Bundles\[BundleName]\Helpers\[HelperName]
        $split = explode("\\", $classpath);
        $bundleName = strtolower($split[3]);
        $helperName = strtolower($split[5]);

        $filePath = realpath(__DIR__ . '/../../bundles/' . $bundleName . '/Helpers/' . $helperName . '.php');

        if ($filePath) {
            require_once $filePath;
        } else {
            throw new Exception('021', [ 'helper' => $classpath ]);
        }
    }

}