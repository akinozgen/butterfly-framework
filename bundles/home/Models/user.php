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
use Butterfly\System\Session;

class UserFactory extends ActiveClass
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param LoginPost $loginPost
     * @return User|null
     */
    public function getByRequest(LoginPost $loginPost) {
        $data = $this->getDatabase()->clean()
            ->select('users', '*')
            ->where([
                'email' => $loginPost->getEmail(),
                'password' => $loginPost->getPassword(true)
            ], 'AND')
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            if (isset($data) && $data->rowCount() > 0) {
                return new User($data->fetch());
            }
        }
        return null;
    }

    public function get($id) {
        $data = $this->getDatabase()->clean()
            ->select('users', 'id, email, name')
            ->where([ 'id' => $id ])
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            return new User($data->fetch());
        } else {
            return null;
        }
    }

    /**
     * @param $email
     * @return User|null
     */
    public function getByEmail($email) {
        $data = $this->getDatabase()->clean()
            ->select('users', '*')
            ->where([ 'email' => $email ])
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            return new User($data->fetch());
        } else {
            return null;
        }
    }

    /**
     * @param User $user
     */
    public function login(User $user) {
        $this->getSessions()->add(new Session('email', $user->getEmail()));
        $this->getSessions()->add(new Session('name', $user->getName()));
        $this->getSessions()->add(new Session('id', $user->getId()));
        $this->getSessions()->add(new Session('last_login', $user->getLastLogin()));
        $this->getSessions()->add(new Session('login', true));
    }

    public function logout() {
        $this->getSessions()->add(new Session('email', false));
        $this->getSessions()->add(new Session('name', false));
        $this->getSessions()->add(new Session('id', false));
        $this->getSessions()->add(new Session('last_login', false));
        $this->getSessions()->add(new Session('login', false));
    }

    /**
     * @param RegisterPost $user
     * @return \PDOStatement
     */
    public function set(RegisterPost $user) {
        $result = $this->getDatabase()->clean()
            ->insert('users', [
                'email' => $user->getEmail(),
                'password' => $user->getPassword(true),
                'name' => $user->getName(),
                'last_login' => date('Y-m-d H:i:s')
            ])
            ->exec(Database::FETCH_OBJ);

        return $result;
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
        $this->id = isset($data->id) ? $data->id : null;
        $this->email = isset($data->email) ? $data->email : null;
        $this->name = isset($data->name) ? $data->name : null;
        $this->password = isset($data->password) ? $data->password : null;
        $this->last_login = isset($data->last_login) ? $data->last_login : null;
    }

    /**
     * @return int
     */
    public function getId()
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