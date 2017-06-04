<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 1:31 AM
 */

namespace Butterfly\System\Cli;

use Butterfly\System\Exception;

/**
 * Class Controller
 * @var string $bundle
 * @var string $controller
 * @var string $classpath
 * @var string $filename
 * @package Butterfly\System\Cli
 */
class Controller
{
    private $bundle;
    private $controller;
    private $classpath;
    private $filename;

    /**
     * Controller constructor.
     * @param $bundle
     * @param $controller
     */
    function __construct($bundle, $controller) {
        $this->bundle = $bundle;
        $this->controller = $controller;
        $this->classpath = "\\Butterfly\\Bundles\\".ucwords($bundle)."\\Controllers\\".ucwords($controller);
        $this->filename = __DIR__ . "/../../bundles/$bundle/Controllers/$controller.php";
    }

    public function createController() {
        if ( ! class_exists($this->classpath) OR ! file_exists($this->filename) ) {
            touch ($this->filename);
            $this->bundle = ucwords($this->bundle);
            $this->controller = ucwords($this->controller);
            $write_file = file_put_contents($this->filename, <<<PHP
<?php

namespace Butterfly\\Bundles\\$this->bundle\\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class $this->controller extends ActiveClass
{

    public function main(Parameters \$parameters = null, Request \$request = null) {
        echo "$this->bundle:$this->controller created successfully.";
    }

}
PHP
            );

            if ( ! $write_file) {
                exec('rm "'.$this->filename.'"');
                throw new Exception('013');
            }
            else return $this->classpath;
        } else {
            throw new Exception("019", [
                'bundle' => $this->bundle,
                'controller' => $this->controller
            ]);
        }
    }

}