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
        $_SESSION[$this->keyname][$session->getKey()] = json_encode([
            'key' => $session->getKey(),
            'value' => $session->getValue()
        ]);
    }

    /**
     * @param string $key
     * @return bool|Session
     */
    public function get($key) {
        if (!isset($_SESSION[$this->keyname][$key])) {
            return new Session($key, false);
        }

        if (is_string($key)) {
            $session = json_decode($_SESSION[$this->keyname][$key]);
            return new Session($session->key, $session->value);
        } else {
            $session = json_decode($_SESSION[$this->keyname][$key->getKey()]);
            return new Session($session->key, $session->value);
        }
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