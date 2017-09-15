<?php
/**
 * Created by PhpStorm.
 * User: Akın Özgen
 * Date: 8.09.2017
 * Time: 15:25
 */

namespace Butterfly\System;

use ReflectionClass;
use ReflectionProperty;

class Converter
{
    /**
     * @param object $object
     * @return array
     */
    public function objectAsArray($object): array {
        $reflect = new ReflectionClass($object);
        $props   = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

        $returnValue = [];

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            if (is_object($prop->getValue($object))) {
                $returnValue[$name] = $this->objectAsArray($prop->getValue($object));
            } else
                $returnValue[$name] = $prop->getValue($object);
            $prop->setAccessible(false);
        }

        return $returnValue;
    }
}