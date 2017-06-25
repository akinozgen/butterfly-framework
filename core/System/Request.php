<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/4/17
 * Time: 1:02 AM
 */

namespace Butterfly\System;


class Request
{

    private $post;
    private $get;
    private $files;

    function __construct() {
        $this->files = $_FILES;
        $this->get = $_GET;
        $this->post = $_POST;
    }

    /**
     * @return mixed
     */
    public function getGet() {
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * @return bool
     */
    public function isGet() {
        return count($this->get) > 0;
    }

    /**
     * @return bool
     */
    public function isPost() {
        return count($this->post) > 0;
    }

    /**
     * @return bool
     */
    public function isFiles() {
        // TODO check for contagious situations for _files values
        return count($this->files) > 0;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function getGetValue($key) {
        // TODO check for contagious situations for _get values
        return isset($this->get[$key]) ? $this->get[$key] : false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function getPostValue($key) {
        // TODO check for contagious situations for _post values
        return isset($this->post[$key]) ? $this->post[$key] : false;
    }

}