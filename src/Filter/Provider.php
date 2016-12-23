<?php

namespace Mound\Filter;

use Mound\ProviderInterface;

/**
 * Class Provider
 * @package Mound\Filter
 */
class Provider implements ProviderInterface
{
    /**
     * @param string $name
     * @param array $keys
     * @param array $options
     * @return Provider
     */
    public function attach(string $name, array $keys, array $options = []): Provider
    {
        return $this;
    }

    /**
     * @param array $data
     * @param array $options
     * @return Provider
     */
    public function exec(array $data, array $options = []): Provider
    {
        return $this;
    }
}