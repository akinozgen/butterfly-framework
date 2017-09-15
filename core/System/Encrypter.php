<?php

namespace Butterfly\System;

/**
 * Description of Encrypter
 *
 * @author Akın Özgen
 */
class Encrypter {

    private $enc_key;

    public function __construct($key) {
        $this->enc_key = $key;
    }

    public function password($string) {
        return md5(sha1($this->enc_key . $string . $this->enc_key));
    }

}
