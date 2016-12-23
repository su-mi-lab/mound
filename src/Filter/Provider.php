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
     * @param string $key
     * @param array $data
     * @return array
     */
    protected function doExec(array $carry, string $key, array $data): array
    {
        // TODO: Implement doExec() method.
    }

    /**
     * @param array $carry
     * @param array $rules
     * @param $value
     * @return array
     */
    protected function doExecRule(array $carry, array $rules, string $name, $value): array
    {
        // TODO: Implement doExecRule() method.
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