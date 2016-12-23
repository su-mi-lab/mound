<?php

namespace Mound\Filter\Rules;

use Mound\Filter\AbstractFilter;

/**
 * Class NotEmptyFilter
 * @package Mound\Filter\Rules
 */
class NotEmptyFilter extends AbstractFilter
{

    /**
     * @param $value
     * @return bool
     */
    protected function isAllow($value): bool
    {
        if (is_array($value)) {
            return (bool)array_filter($value, function ($row) {
                return $this->isAllow($row);
            });
        }

        if ($value === null || $value === '') {
            return false;
        }

        return true;
    }
}