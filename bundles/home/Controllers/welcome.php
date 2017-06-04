<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 12:36 AM
 */

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Welcome extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('home/welcome/main.twig', [
            'title' => 'Main',
            'message' => 'Greetings from home:welcome:main...',
        ]);
    }

}