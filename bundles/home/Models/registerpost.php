<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 3:33 PM
 */

namespace Butterfly\Bundles\Home\Models;

use Butterfly\System\ActiveClass;
use Butterfly\System\Request;

class RegisterPostFactory extends ActiveClass
{
    function __construct()
    {
        parent::__construct();
    }

    public function get(Request $request) {
        return new RegisterPost($request);
    }
}

class RegisterPost {
    private $email;
    private $name;
    private $password;
    private $repassword;

    function __construct(Request $request)
    {
        $this->email = $request->getPostValue('email');
        $this->name = $request->getPostValue('name');
        $this->password = $request->getPostValue('password');
        $this->repassword = $request->getPostValue('repassword');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param bool $encoded
     * @return string
     */
    public function getPassword($encoded = false) {
        return $encoded ? md5(md5(sha1('BUTTERFLY' . $this->password . 'BUTTERFLY'))) : $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param bool $encoded
     * @return string
     */
    public function getRePassword($encoded = false) {
        return $encoded ? md5(md5(sha1('BUTTERFLY' . $this->repassword . 'BUTTERFLY'))) : $this->repassword;
    }
}