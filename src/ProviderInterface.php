<?php

namespace Mound;

/**
 * Interface ProviderInterface
 * @package Mound
 *
 * @property ProviderInterface $endRule
 * @property ProviderInterface $endGroup
 */
interface ProviderInterface
{

    /**
     * @param string $key
     * @return ProviderInterface
     */
    public function rule(string $key): ProviderInterface;

    /**
     * @param string $key
     * @return ProviderInterface
     */
    public function group(string $key): ProviderInterface;

    /**
     * @param $rule
     * @param array $options
     * @return ProviderInterface
     */
    public function attach($rule, array $options = []): ProviderInterface;

    /**
     * @param array $data
     * @param array $groups
     * @return array
     */
    public function exec(array $data, array $groups): array;
}