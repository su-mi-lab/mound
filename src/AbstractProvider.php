<?php

namespace Mound;

/**
 * Class AbstractProvider
 * @package Mound
 */
abstract class AbstractProvider implements ProviderInterface
{

    /**
     * @var null
     */
    protected $target = null;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @param string $key
     * @return ProviderInterface
     */
    public function rule(string $key): ProviderInterface
    {
        $this->target = $key;
        return $this;
    }

    /**
     * @param $rule
     * @param array $options
     * @return ProviderInterface
     */
    public function attach($rule, array $options = []): ProviderInterface
    {
        $this->rules[$this->target][] = $this->factory($rule, $options);
        return $this;
    }

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
    abstract protected function doExecRule(array $carry, array $rules, string $name, $value): array;


    /**
     * @param $rule
     * @param array $options
     * @return RuleInterface
     */
    abstract protected function factory($rule, array $options): RuleInterface;
}