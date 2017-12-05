<?php

/**
 * Created by PhpStorm.
 * User: Akın Özgen
 * Date: 20.06.2017
 * Time: 12:24
 */

namespace Butterfly\System;

class Loader {

    function __construct() {
        $dirname = opendir(realpath(__DIR__ . '/../../bundles/'));
        $bundles = [];

        while ($item = readdir($dirname)) {
            if (!in_array($item, ['.', '..']))
                $bundles[] = $item;
        }

        foreach ($bundles as $bundle) {
            $dirModels = opendir(realpath(__DIR__ . '/../../bundles/' . $bundle . '/Models/'));
            $dirSchemas = opendir(realpath(__DIR__ . '/../../bundles/' . $bundle . '/Schemas/'));
            $dirHelpers = opendir(realpath(__DIR__ . '/../../bundles/' . $bundle . '/Helpers/'));

            while ($item = @readdir($dirModels)) {
                if (!in_array($item, ['.', '..']))
                    require_once(__DIR__ . '/../../bundles/' . $bundle . '/Models/' . $item);
            }

            while ($item = @readdir($dirSchemas)) {
                if (!in_array($item, ['.', '..']))
                    require_once(__DIR__ . '/../../bundles/' . $bundle . '/Schemas/' . $item);
            }

            while ($item = @readdir($dirHelpers)) {
                if (!in_array($item, ['.', '..']))
                    require_once(__DIR__ . '/../../bundles/' . $bundle . '/Helpers/' . $item);
            }
        }
    }

}
