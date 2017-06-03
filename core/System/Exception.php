<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/3/17
 * Time: 11:44 PM
 */

namespace Butterfly\System;

use Throwable;

class Exception extends \Exception implements Throwable
{
    private $errorCode;

    /**
     * Exception constructor.
     * @param string $errorCode
     * @param array $values
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($errorCode = '', $values = [], $code = 0, Throwable $previous = null)
    {
        $error_codes = json_decode(
            file_get_contents( realpath(__DIR__ . '/../Config/errors.json') )
            , true);
        $message = $error_codes[$errorCode];
        $this->errorCode = $errorCode;

        foreach ($values as $key => $value) {
            $message = str_replace('%'.$key, $value, $message);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

}