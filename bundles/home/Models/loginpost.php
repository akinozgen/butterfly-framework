<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 2:40 PM
 */

namespace Butterfly\Bundles\Home\Models;

use Butterfly\System\ActiveClass;
use Butterfly\System\Request;

class LoginPostFactory extends ActiveClass
{

    function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request) {
        return new LoginPost($request);
    }

}

class LoginPost {

    private $email;
    private $password;
    private $remember;

    function __construct(Request $request)
    {
        $this->email = $request->getPostValue('email');
        $this->password = $request->getPostValue('password');
        $this->remember = $request->getPostValue('remember');
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param bool $encoded
     * @return string
     */
    public function getPassword($encoded = false) {
        return $encoded ? md5(md5(sha1('BUTTERFLY' . $this->password . 'BUTTERFLY'))) : $this->password;
    }

    /**
     * @return bool
     */
    public function getRemember() {
        return $this->remember;
    }

}