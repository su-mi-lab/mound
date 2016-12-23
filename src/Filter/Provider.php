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
     * @param $rule
     * @param array $options
     * @return RuleInterface
     * @throws \Exception
     */
    protected function factory($rule, array $options): RuleInterface
    {
        $injection = new Injection($rule);
        $instance = $injection->newInstance($options);

        if (!($instance instanceof AbstractFilter)) {
            throw new \Exception('not instanceof AbstractFilter');
        }

        return $instance;
    }
}