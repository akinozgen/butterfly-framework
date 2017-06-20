<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 1:32 AM
 */
namespace Butterfly\System\Cli;

use Butterfly\System\Exception;

/**
 * Class Processor
 * @package Butterfly\System\Cli
 */
class Processor
{
    /**
     * Processor constructor.
     * @param array $values
     * @param int $count
     * @throws Exception
     */
    function __construct($values, $count) {
        global $config;
        if (
            $count > 0
            && @in_array($values[1], $config['defaults']->allowed_cli_commands) ||
            @in_array($values[2], $config['defaults']->allowed_cli_commands)
        ) {
            switch ($values[1]) {
                case 'create': $this->create($values); break;
                case 'remove': $this->remove($values); break;
                case 'check':  $this->check($values); break;
                case '--help': $this->help(); break;
                case '-h':     $this->help(); break;
                default: throw new Exception("008", ['cmd'=>$values[0]]); break;
            }
        } else {
            throw new Exception("009");
        }
    }

    private function create($values) {
        global $config;
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    $bundle->createBundle($config);
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                }
                break;
            case 'controller':
                $split = explode(':', $values[3]);
                $controller = new Controller($split[0], $split[1]);

                try {
                    $create = $controller->createController();

                    if ($create) {
                        echo "Success!\n";
                        echo "Route name for this controller [blank if you dont want to add]: ";
                        $route = readline();

                        if ($route) {
                            $route = new Route($route, $controller->getClasspath());

                            if ($route->createRoute()) {
                                echo "Route '{$route->getRoutepath()}' created for controller '{$route->getClasspath()}'";
                            } else {
                                throw new Exception("018", [
                                    'route' => $route->getRoutepath()
                                ]);
                            }
                        }
                    }
                } catch (Exception $exception) {
                    echo $exception->getErrorMessage();
                }
                break;
            case 'route':
                $route = new Route($values[3], $values[4]);

                if ($route->createRoute()) {
                    echo "Success!";
                } else {
                    throw new Exception("018", [ 'route' => $route->getRoutepath() ]);
                }
                break;
            default: throw new Exception('010', ['cmd' => 'create']); break;
        }
    }

    private function remove($values) {
        global $config;
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    $bundle->removeBundle($config);
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                }
                break;
            case 'controller':
                $split = explode(':', $values[3]);
                $controller = new Controller($split[0], $split[1]);

                try {
                    $remove = $controller->removeController();

                    if ($remove) {
                        echo "Success!\n";
                        echo "Route path for this controller [blank if not exists]: ";
                        $route = readline();

                        if ($route) {
                            $route = new Route($route, $controller->getClasspath());

                            if ($route->removeRoute($route)) {
                                echo "Route '{$route->getRoutepath()}' for '{$route->getClasspath()}' removed.";
                            } else {
                                throw new Exception('019', [
                                    'route' => $route->getRoutepath()
                                ]);
                            }
                        }
                    }
                } catch (Exception $exception) {
                    echo $exception->getErrorMessage();
                }
                break;
            case 'route':
                if (Route::removeRoute($values[3])) {
                    echo "Success!";
                } else {
                    throw new Exception("019", [ 'route' => $route->getRoutepath() ]);
                }
                break;
            default: throw new Exception('010', ['cmd' => 'remove']); break;
        }
    }

    private function check($values) {
        global $config;
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    if ($bundle->checkBundle($config)) {
                        throw new Exception("015");
                    } else {
                        throw new Exception("016");
                    }
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                }
                break;
            case 'controller':
                $split = explode(':', $values[2]);
                $bundle = $split[0];
                $controller = $split[1];
                break;
            default: throw new Exception('010', ['cmd' => 'remove']); break;
        }
    }

    private function help() {
        echo <<<TXT
usage: butterfly [command] [sub-command] [value1] [value2 = ""]
    commands:
        create 
        delete
        check
     sub-commands
        [create, remove, check] bundle
        [create, remove, check] controller
        [create, remove] route
     
    examples: 
        $ butterlfy create bundle deneme
        $ butterfly create controller deneme:home
            -- deneme is bundle name
            -- home is controller name
        $ butterfly create route login Butterfly\Bundles\Home\Controllers\Welcome\Main
            -- login is route key name
            -- Home is bundle name
            -- Welcome is controller name
            -- Main is method name
TXT;

    }

}