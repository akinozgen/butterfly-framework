<?php

namespace Butterfly\Bundles\User\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Home extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('user/home/main.twig', [
            'title' => 'Main',
            'message' => 'Greetings from user:home:main...',
        ]);
    }

}