<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 1:30 AM
 */

namespace Butterfly\System\Cli;

use Butterfly\System\Exception;

/**
 * Class Bundle
 * @package Butterfly\System\Cli
 */
class Bundle
{
    /**
     * @var string
     */
    private $name;

    function __construct($name) {
        if ($name)
            $this->name = $name;
        else
            throw new Exception("012");
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName($value) {
        $this->name = $value;
    }

    public function createBundle($config) {
        $dirs = $config['defaults']->bundle_structure->dirs;
        $files = $config['defaults']->bundle_structure->files;

        if ( ! file_exists(__DIR__ . '/../../bundles/' . $this->name) ) {
            mkdir (__DIR__ . '/../../bundles/' . $this->name);
        } else {
            throw new Exception(
                '011',
                [
                    'directory' => realpath(__DIR__ . '/../../bundles/' . $this->name)
                ]
            );
        }

        foreach ($dirs as $dir) {
            mkdir (__DIR__ . '/../../bundles/'.$this->name.'/'.$dir);
        }
        foreach ($files as $file) {
            touch (__DIR__ . '/../../bundles/'.$this->name.'/'.$file);
        }

        $this->name = ucwords($this->name);
        $write_file = file_put_contents(
            __DIR__ . '/../../bundles/'.strtolower($this->name).'/Controllers/home.php',
            <<<PHP
<?php

namespace Butterfly\\Bundles\\$this->name\\Controllers;

use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Home
{

    public function main(Parameters \$parameters = null, Request \$request = null) {
        echo "Welcome to {$this->name}, default:main";
    }

}
PHP

        );
        if ($write_file) {
            echo "Success!";
        } else {
            if ( strlen($this->name) > 1 )
                exec("rm -R " . __DIR__ . '/../../bundles/' . strtolower($this->name));
            throw new Exception("013");
        }
    }

    public function removeBundle() {
        if ( strlen($this->name) > 1 && file_exists(__DIR__ . '/../../bundles/' . strtolower($this->name)) ) {
            exec("rm -R " . __DIR__ . '/../../bundles/' . strtolower($this->name));
            echo 'Success!';
        }
        else
            throw new Exception("014");
    }

    public function checkBundle($config) {
        if (file_exists(__DIR__ . '/../../bundles/'.strtolower($this->name)))
        {
            foreach ($config['defaults']->bundle_structure->dirs as $dir) {
                if ( ! file_exists(__DIR__ . '/../../bundles/'.strtolower($this->name).'/'.$dir)) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

}