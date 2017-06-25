<?php

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Home extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('home/home/sub/main.twig', [
            'title' => 'Main',
            'message' => 'Creating success',
        ]);
    }

    public function login(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('home/home/sub/login.twig', [
            'title' => 'Login',
            'message' => 'Do login to your account'
        ]);
    }

}