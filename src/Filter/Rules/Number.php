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
     * @param array $context
     * @return bool
     */
    protected function isAllow($value, array $context): bool
    {
        return is_numeric($value);
    }
}