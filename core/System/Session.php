<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 3:02 PM
 */

namespace Butterfly\System;


class Sessions
{
    private $keyname;

    function __construct($keyname = null)
    {
        $this->keyname = $keyname;
    }

    /**
     * @param Session $session
     */
    public function add(Session $session) {
        $_SESSION[$this->keyname][$session->getKey()] = $session;
    }

    /**
     * @param string $key
     * @return Session|null
     */
    public function get($key) {
        return isset($_SESSION[$this->keyname][$key]) ? new Session($_SESSION[$this->keyname][$key]->getKey(), $_SESSION[$this->keyname][$key]->getValue()) : null;
    }

    /**
     * @param Session|string $key
     */
    public function remove($key) {
        if (is_string($key)) {
            $_SESSION[$this->keyname][$key] = false;
        } else {
            $_SESSION[$this->keyname][$key->getKey()] = false;
        }
    }
}

class Session {
    private $key;
    private $value;

    function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}