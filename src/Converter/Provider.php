<?php

namespace Mound\Converter;

use Mound\AbstractProvider;
use Mound\RuleInterface;

/**
 * Class Provider
 * @package Mound\Converter
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
            $carry[$name] = $rule->call($value);
            return $carry;
        }, $carry);
    }

    /**
     * @param $instance
     * @return bool
     */
    protected function isAllowInstance($instance): bool
    {
        return ($instance instanceof AbstractConverter);
    }
}