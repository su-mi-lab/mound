<?php

namespace Mound;

/**
 * Interface ProviderInterface
 * @package Mound
 */
interface ProviderInterface
{
    /**
     * @param string $name
     * @param array $keys
     * @param array $options
     * @return ProviderInterface
     */
    public function attach(string $name, array $keys, array $options = []): static;

    /**
     * @param array $data
     * @param array $options
     * @return ProviderInterface
     */
    public function exec(array $data, array $options = []): static;
}