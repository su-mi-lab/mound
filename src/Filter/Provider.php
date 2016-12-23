<?php

namespace Mound\Filter;

use Mound\AbstractProvider;
use Mound\Injection;
use Mound\RuleInterface;

/**
 * Class Provider
 * @package Mound\Filter
 */
class Provider extends AbstractProvider
{
    /**
     * @param array $carry
     * @param array $rules
     * @param $value
     * @return array
     */
    protected function doExecRule(array $carry, array $rules, string $name, $value): array
    {
        return array_reduce($rules, function ($carry, $rule) use ($value, $name) {
            /** @var RuleInterface $rule */
            if ($rule->call($value)) {
                $carry[$name] = $value;
            }

            return $carry;
        }, $carry);
    }

    /**
     * @param $instance
     * @return bool
     */
    protected function isAllowInstance($instance): bool
    {
        return ($instance instanceof AbstractFilter);
    }
}