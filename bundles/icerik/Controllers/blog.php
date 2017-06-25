<?php

namespace Butterfly\Bundles\Icerik\Controllers;

use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Blog extends ActiveClass
{

    public function main(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('icerik/blog/main.twig');
    }

    public function ekle(Parameters $parameters = null, Request $request = null) {
        echo $this->getTwig()->render('icerik/blog/ekle .twig');
    }

}