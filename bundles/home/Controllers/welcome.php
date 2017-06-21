<?php

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\Bundles\Home\Models\Example;
use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Welcome extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {

        $this->getLoader()->loadHelper('\Butterfly\Bundles\Home\Helpers\Example_Helper');

        $this->getLoader()->loadModel('\Butterfly\Bundles\Home\Models\Example');

        $model = new Example();

        echo $this->getTwig()->render('home/welcome/main.twig', [
            'title' => 'Main',
            'message' => 'Greetings from home:welcome:main...',
        ]);
    }

}