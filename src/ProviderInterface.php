<?php

namespace Mound;

/**
 * Interface ProviderInterface
 * @package Mound
 */
interface ProviderInterface
{

    /**
     * @param string $key
     * @return ProviderInterface
     */
    public function rule(string $key): ProviderInterface;

    /**
     * @param $rule
     * @param array $options
     * @return ProviderInterface
     */
    public function attach($rule, array $options = []): ProviderInterface;

    /**
     * @param array $data
     * @return array
     */
    public function exec(array $data): array;
}