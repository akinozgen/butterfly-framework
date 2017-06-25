<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 6:47 PM
 */

namespace Butterfly\System;

class Uploader
{
    private $file;
    private $uploadPath;
    private $result;

    function __construct($key)
    {
        $this->file = $_FILES[$key];
        $info = pathinfo($this->file['name']);
        $this->file['name'] = $info['filename'] . '_' . time() . '.' . $info['extension'];
    }

    public function setPath($path = __DIR__ . '/../../public/uploads/') {
        $this->uploadPath = realpath($path ) . '/' . $this->file['name'];
        return $this;
    }

    public function upload() {
        $this->result =  move_uploaded_file($this->file['tmp_name'], $this->uploadPath);
        return $this;
    }

    public function getResult() {
        return $this->result;
    }

    public function getUrl() {
        return URL . 'public/uploads/' . $this->file['name'];
    }
}