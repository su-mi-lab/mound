<?php

namespace Mound\Converter;

use Mound\RuleInterface;

/**
 * Class AbstractConverter
 * @package Mound\Converter
 */
abstract class AbstractConverter implements RuleInterface
{

    /**
     * @param $value
     * @return mixed
     */
    public function call($value)
    {
        return $value;
    }
}