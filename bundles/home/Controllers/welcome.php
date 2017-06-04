<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 12:36 AM
 */

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\System\Parameters;
use Butterfly\System\Request;

class Welcome
{

    public function main(Parameters $parameters = null, Request $request = null) {
        print_r($request);
    }

}