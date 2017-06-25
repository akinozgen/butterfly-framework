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
            mkdir (__DIR__ . '/../../views/' . $this->name);
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
            touch (__DIR__ . '/../../bundles/'.$this->name.'/'.$file.'.php');
            mkdir (__DIR__ . '/../../views/'.$this->name.'/'.pathinfo($file, PATHINFO_BASENAME));
            touch (__DIR__ . '/../../views/'.$this->name.'/'.pathinfo($file, PATHINFO_BASENAME).'/main.twig');
        }

        $this->name = ucwords($this->name);
        $now_year   = date('Y');
        $name       = strtolower($this->name);
        $write_file = file_put_contents(
            __DIR__ . '/../../bundles/'.strtolower($this->name).'/Controllers/home.php',
            <<<PHP
<?php

namespace Butterfly\\Bundles\\$this->name\\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Home extends ActiveClass
{

    public function main(Parameters \$parameters = null, Request \$request = null) {
        echo \$this->getTwig()->render('$name/home/masterpage.twig', [
            'title' => 'Main',
            'message' => 'Greetings from $name:home:main...',
        ]);
    }

}
PHP
        );
        $write_file2 = file_put_contents(
            __DIR__ . '/../../views/'.strtolower($this->name).'/home/main.twig',
            <<<HTML
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{{ application_name }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Sign in</button>
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Hello, world!</h1>
            <p>{{ message }}</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; $now_year {{ application_name }}, Inc.</p>
        </footer>
    </div> <!-- /container -->
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"><\/script>')</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;e=o.createElement(i);r=o.getElementsByTagName(i)[0];e.src='//www.google-analytics.com/analytics.js';r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
</body>
</html>
HTML
        );
        if ($write_file && $write_file2) {
            echo "Success!";
        } else {
            if ( strlen($this->name) > 1 ){
                exec("rm -R " . __DIR__ . '/../../bundles/' . strtolower($this->name));
                //exec("rm -R " . __DIR__ . '/../../views/' . strtolower($this->name));
            }
            throw new Exception("013");
        }
    }

    public function removeBundle() {
        if ( strlen($this->name) > 1 && file_exists(__DIR__ . '/../../bundles/' . strtolower($this->name)) ) {
            exec("rm -R " . __DIR__ . '/../../bundles/' . strtolower($this->name));
            exec("rm -R " . __DIR__ . '/../../views/' . strtolower($this->name));
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