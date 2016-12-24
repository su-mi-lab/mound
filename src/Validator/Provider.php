<?php

namespace Mound\Validator;

use Mound\AbstractProvider;

/**
 * Class Provider
 * @package Mound\Validator
 */
class Provider extends AbstractProvider
{
    /**
     * @param array $carry
     * @param array $rules
     * @param string $name
     * @param $value
     * @param array $context
     * @return array
     */
    protected function doExecRule(array $carry, array $rules, string $name, $value, array $context): array
    {
        return array_reduce($rules, function ($carry, $rule) use ($value, $name, $context) {

            if (isset($carry[$name])) {
                return $carry;
            }

            /** @var AbstractValidator $rule */
            if (!$rule->call($value, $context)) {
                $carry[$name][] = $rule->message();
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
        return ($instance instanceof AbstractValidator);
    }
}