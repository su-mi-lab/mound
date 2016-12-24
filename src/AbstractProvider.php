<?php

namespace Mound;

/**
 * Class AbstractProvider
 * @package Mound
 *
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

        return $this->doExecRule($carry, $rules, $key, $value, $data);
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

        if (!$this->isAllowInstance($instance)) {
            throw new \Exception('Bat instance');
        }

        return $instance;
    }

    /**
     * @param array $carry
     * @param array $rules
     * @param string $name
     * @param $value
     * @param array $context
     * @return array
     */
    abstract protected function doExecRule(array $carry, array $rules, string $name, $value, array $context): array;

    /**
     * @param $instance
     * @return bool
     */
    abstract protected function isAllowInstance($instance): bool;

    /**
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        switch ($name) {
            case 'end':
                $this->target = null;
                return $this;
            default:
                return $this;
        }

    }

}