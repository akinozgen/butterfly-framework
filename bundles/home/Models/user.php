<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 2:47 PM
 */

namespace Butterfly\Bundles\Home\Models;

use Butterfly\System\ActiveClass;
use Butterfly\System\Database;

class UserFactory extends ActiveClass
{
    function __construct()
    {
        parent::__construct();
    }

    public function getByRequest(LoginPost $loginPost) {
        $data = $this->getDatabase()->clean()
            ->select('users', '*')
            ->where([
                'email' => $loginPost->getEmail(),
                'password' => $loginPost->getPassword(true)
            ])
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            return new User($data->fetch());
        } else {
            return null;
        }
    }

    public function login(User $user) {

    }
}

class User {
    /**
     * @var int $id
     * @var string $email
     * @var string $name
     * @var string $password
     * @var string $last_login
     */
    private $id;
    private $email;
    private $name;
    private $password;
    private $last_login;

    function __construct($data)
    {
        /**@var User $data*/
        $this->id = $data->id;
        $this->email = $data->email;
        $this->name = $data->name;
        $this->password = $data->password;
        $this->last_login = $data->last_login;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password, $encoded = false)
    {
        if (!$encoded) {
            $this->password = md5(md5(sha1('BUTTERFLY' . $password . 'BUTTERFLY')));
        } else {
            $this->password = $password;
        }
    }
}