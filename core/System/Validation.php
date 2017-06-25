<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 5:15 PM
 */

namespace Butterfly\System;

class Validation
{
    private $check;
    private $result;

    function __construct()
    {
        $this->check = false;
        $this->result = [];
    }

    public function validate_pairs($pair1, $pair2, $label = 'pairs') {
        if ($pair2 === $pair1) {
            $this->check = true;
            $this->result[$label] = 'passed';
        }
        else {
            $this->check = false;
            $this->result[$label] = 'failed';
        }

        return $this;
    }

    public function validate_email($email, $label = 'email') {
        //TODO: email validation condition
        if (true) {
            $this->check = true;
            $this->result[$label] = 'passed';
        } else {
            $this->check  = false;
            $this->result[$label] = 'failed';
        }

        return $this;
    }

    public function validate_length($str, $min, $max, $label = 'length') {
        if (strlen($str) <= $max && strlen($str) >= $min) {
            $this->check = true;
            $this->result[$label] = 'passed';
        } else {
            $this->check = false;
            $this->result[$label] = 'failed';
        }

        return $this;
    }

    public function get_result() {
        return $this->result;
    }
}