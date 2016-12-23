<?php

namespace Mound\Filter\Rules;

use Mound\Filter\AbstractFilter;

/**
 * Class Number
 * @package Mound\Filter\Rules
 */
class Number extends AbstractFilter
{
    /**
     * @param $value
     * @return bool
     */
    protected function isAllow($value): bool
    {
        return is_numeric($value);
    }
}