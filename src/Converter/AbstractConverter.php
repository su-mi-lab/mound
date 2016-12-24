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
     * @var array
     */
    protected $context = [];
    
    /**
     * @param $value
     * @param array $context
     * @return mixed
     */
    public function call($value, array $context = [])
    {
        $this->context = $context;
        return $this->convert($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    abstract protected function convert($value);
}