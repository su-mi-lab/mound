<?php

namespace Mound\Filter;

use Mound\RuleInterface;

/**
 * Class AbstractFilter
 * @package Mound\Filter
 */
abstract class AbstractFilter implements RuleInterface
{
    /**
     * @var array
     */
    protected $context = [];
    
    /**
     * @param $value
     * @param array $context
     * @return bool
     */
    public function call($value, array $context = []): bool
    {
        $this->context = $context;
        return $this->isAllow($value);
    }

    /**
     * @param $value
     * @param array $context
     * @return bool
     */
    abstract protected function isAllow($value): bool;
}