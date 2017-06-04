<?php

namespace Butterfly\Bundles\User\Controllers;

use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Home
{

    public function main(Parameters $parameters = null, Request $request = null) {
        echo "Welcome to User, default:main";
    }

}