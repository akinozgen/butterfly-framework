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
     * @var array
     */
    private $config;

    /**
     * Processor constructor.
     * @param array $values
     * @param int $count
     * @param array $config
     * @throws Exception
     */
    function __construct($values, $count, $config) {
        if (
            $count > 0
            && @in_array($values[1], $config['defaults']->allowed_cli_commands) &&
            @in_array($values[2], $config['defaults']->allowed_cli_commands)
        ) {
            $this->config = $config;
            switch ($values[1]) {
                case 'create': $this->create($values); break;
                case 'remove': $this->remove($values); break;
                case 'check':  $this->check($values); break;
                default: throw new Exception("008", ['cmd'=>$values[0]]); break;
            }
        } else {
            throw new Exception("009");
        }
    }

    private function create($values) {
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    $bundle->createBundle($this->config);
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
                            $route = new Route($route, $create);

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
            case 'method':
                $split = explode(':', $values[2]);
                $bundle = $split[0];
                $controller = $split[1];
                $method = $split[2];
                break;
            default: throw new Exception('010', ['cmd' => 'create']); break;
        }
    }

    private function remove($values) {
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    $bundle->removeBundle($this->config);
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                }
                break;
            case 'controller':
                $split = explode(':', $values[2]);
                $controller = new Controller($split[0], $split[1]);

                try {
                    $create = $controller->createController();
                } catch (Exception $exception) {
                    echo $exception->getErrorMessage();
                }
                break;
            case 'method':
                $split = explode(':', $values[2]);
                $bundle = $split[0];
                $controller = $split[1];
                $method = $split[2];
                break;
            default: throw new Exception('010', ['cmd' => 'remove']); break;
        }
    }

    private function check($values) {
        switch ($values[2]) {
            case 'bundle':
                $bundle = new Bundle(@$values[3]);

                try {
                    if ($bundle->checkBundle($this->config)) {
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
            case 'method':
                $split = explode(':', $values[2]);
                $bundle = $split[0];
                $controller = $split[1];
                $method = $split[2];
                break;
            default: throw new Exception('010', ['cmd' => 'remove']); break;
        }
    }

}