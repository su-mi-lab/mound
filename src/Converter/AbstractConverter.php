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
     * @param array $context
     * @return mixed
     */
    public function call($value, array $context = [])
    {
        return $this->convert($value, $context);
    }

    /**
     * @param $value
     * @param array $context
     * @return mixed
     */
    abstract protected function convert($value, array $context);
}