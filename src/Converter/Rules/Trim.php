<?php

namespace Mound\Converter\Rules;

use Mound\Converter\AbstractConverter;

/**
 * Class Trim
 * @package Mound\Converter\Rules
 */
class Trim extends AbstractConverter
{
    /**
     * @param $value
     * @param array $context
     * @return string
     */
    protected function convert($value, array $context): string
    {
        $value = preg_replace('/^[ 　]+/u', ' ', $value);
        $value = preg_replace('/[ 　]+$/u', ' ', $value);
        return trim($value);
    }
}