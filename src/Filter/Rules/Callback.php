<?php

namespace Mound\Filter\Rules;

use Mound\Filter\AbstractFilter;

/**
 * Class Callback
 * @package Mound\Filter\Rules
 */
class Callback extends AbstractFilter
{
    private $callback;

    /**
     * Callback constructor.
     * @param $callback
     */
    function __construct($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isAllow($value): bool
    {
        $callable = $this->callback;
        return (bool)$callable($value, $this->context);
    }
}