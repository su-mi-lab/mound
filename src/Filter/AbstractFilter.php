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
     * @param $value
     * @param array $context
     * @return bool
     */
    public function call($value, array $context = []): bool
    {
        return $this->isAllow($value, $context);
    }

    /**
     * @param $value
     * @param array $context
     * @return bool
     */
    abstract protected function isAllow($value, array $context): bool;
}