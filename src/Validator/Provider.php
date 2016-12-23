<?php

namespace Mound\Validator;

use Mound\AbstractProvider;
use Mound\Injection;
use Mound\RuleInterface;

/**
 * Class Provider
 * @package Mound\Validator
 */
class Provider extends AbstractProvider
{

    /**
     * @param array $data
     * @return array
     */
    public function exec(array $data): array
    {
        return array_reduce(array_keys($this->rules), function ($carry, $key) use ($data) {
            return $this->doExec($carry, $key, $data);
        }, []);
    }

    /**
     * @param array $carry
     * @param string $key
     * @param array $data
     * @return array
     */
    protected function doExec(array $carry, string $key, array $data): array
    {
        $rules = $this->rules[$key];
        $value = $data[$key] ?? null;

        if ($value === null) {
            return $carry;
        }

        return $this->doExecRule($carry, $rules, $key, $value);
    }

    /**
     * @param array $carry
     * @param array $rules
     * @param $value
     * @return array
     */
    protected function doExecRule(array $carry, array $rules, string $name, $value): array
    {
        return array_reduce($rules, function ($carry, $rule) use ($value, $name) {
            /** @var AbstractValidator $rule */
            if (!$rule->call($value)) {
                $carry[$name][] = $rule->message();
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

        if (!($instance instanceof AbstractValidator)) {
            throw new \Exception('not instanceof AbstractValidator');
        }

        return $instance;
    }
}