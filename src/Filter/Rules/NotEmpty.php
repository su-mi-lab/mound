<?php

namespace Mound\Filter\Rules;

use Mound\Filter\AbstractFilter;

/**
 * Class NotEmpty
 * @package Mound\Filter\Rules
 */
class NotEmpty extends AbstractFilter
{
    /**
     * @param $value
     * @return bool
     */
    protected function isAllow($value, array $context): bool
    {
        if (is_array($value)) {
            return (bool)array_filter($value, function ($row) use ($context) {
                return $this->isAllow($row, $context);
            });
        }

        if ($value === null || $value === '') {
            return false;
        }

        return true;
    }
}