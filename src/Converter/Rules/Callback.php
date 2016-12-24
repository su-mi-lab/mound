<?php

namespace Mound\Converter\Rules;

use Mound\Converter\AbstractConverter;

/**
 * Class Callback
 * @package Mound\Converter\Rules
 */
class Callback extends AbstractConverter
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
     * @return string
     */
    protected function convert($value): string
    {
        $callable = $this->callback;
        return $callable($value, $this->context);
    }
}