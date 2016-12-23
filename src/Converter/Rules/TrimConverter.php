<?php

namespace Mound\Converter\Rules;

use Mound\Converter\AbstractConverter;

/**
 * Class TrimConverter
 * @package Mound\Converter\Rules
 */
class TrimConverter extends AbstractConverter
{

    /**
     * @param $value
     * @return string
     */
    protected function convert($value): string
    {
        $value = preg_replace('/^[ 　]+/u', ' ', $value);
        $value = preg_replace('/[ 　]+$/u', ' ', $value);
        return trim($value);
    }
}