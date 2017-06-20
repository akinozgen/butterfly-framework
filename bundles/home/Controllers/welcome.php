<?php

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Welcome extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {

        $this->getLoader()->loadHelper('example_helper');

        echo $this->getTwig()->render('home/welcome/main.twig', [
            'title' => 'Main',
            'message' => 'Greetings from home:welcome:main...',
        ]);
    }

}