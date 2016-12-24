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
     * @var null
     */
    protected $groupName = null;

    /**
     * @var array
     */
    protected $groups = [];

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
     * @param string $key
     * @return ProviderInterface
     */
    public function group(string $key): ProviderInterface
    {
        $this->groupName = $key;
        return $this;
    }

    /**
     * @param $rule
     * @param array $options
     * @return ProviderInterface
     * @throws \Exception
     */
    public function attach($rule, array $options = []): ProviderInterface
    {
        if (!$this->target && !$this->groupName) {
            throw new \Exception('invalid value in attach.');
        }

        if ($this->groupName) {
            $this->groups[$this->groupName][$this->target][] = $this->factory($rule, $options);
        } else if ($this->target) {
            $this->rules[$this->target][] = $this->factory($rule, $options);
        }

        return $this;
    }

    /**
     * @param array $data
     * @param array $groups
     * @return array
     */
    public function exec(array $data, array $groups = []): array
    {
        if ($groups) {
            $this->attachGroup($groups);
        }

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
     * @param array $groups
     */
    private function attachGroup(array $groups)
    {
        $this->rules = array_reduce($groups, 'static::doAttachGroup', $this->rules);
    }

    /**
     * @param array $rules
     * @param string $groupName
     * @return array
     */
    private function doAttachGroup(array $rules, string $groupName): array
    {
        return array_reduce(array_keys($this->groups[$groupName]), function ($rules, $key) use ($groupName) {
            $row = $this->groups[$groupName][$key];
            $rules[$key] = array_reduce($row, 'static::doAttachGroupRule', $rules[$key]);
            return $rules;
        }, $rules);
    }

    /**
     * @param array $rules
     * @param RuleInterface $rule
     * @return array
     */
    private function doAttachGroupRule(array $rules, RuleInterface $rule): array
    {
        $rules[] = $rule;
        return $rules;
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
            case 'endRule':
                $this->target = null;
                return $this;
            case 'endGroup':
                $this->groupName = null;
                return $this;
            default:
                return $this;
        }

    }
}