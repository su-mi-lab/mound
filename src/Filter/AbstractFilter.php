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
     * @return bool
     */
    public function call($value): bool
    {
        return $this->isAllow($value);
    }

    /**
     * @param $value
     * @return bool
     */
    abstract protected function isAllow($value): bool;
}