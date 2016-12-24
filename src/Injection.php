<?php

namespace Mound;

/**
 * Class Injection
 * @package Mound
 */
class Injection
{
    /**
     * @var \ReflectionClass
     */
    private $reader;

    /**
     * Injection constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->reader = new \ReflectionClass($name);
    }

    /**
     * @param array $options
     * @return object
     */
    public function newInstance(array $options)
    {
        $args = [];
        if ($this->reader->hasMethod('__construct')) {
            $parameters = $this->reader->getMethod('__construct')->getParameters();
            $args = $this->getArgument($parameters, $options);
        }

        return $this->reader->newInstanceArgs($args);
    }

    /**
     * @param string $name
     * @param $object
     * @param array $options
     * @return mixed|null
     */
    public function invoke(string $name, $object, array $options)
    {
        if ($this->reader->hasMethod($name)) {
            $parameters = $this->reader->getMethod($name)->getParameters();
            $args = $this->getArgument($parameters, $options);

            return $this->reader->getMethod($name)->invokeArgs($object, $args);
        }

        return null;
    }

    /**
     * @param \ReflectionParameter[] $parameters
     * @param array $args
     * @return array
     */
    private function getArgument(array $parameters, array $args): array
    {
        return array_reduce($parameters, function ($carry, $parameter) use ($args) {
            /** @var \ReflectionParameter $parameter */
            $parameterName = $parameter->getName();

            if (isset($args[$parameterName])) {
                $carry[$parameterName] = $args[$parameterName];
            } else if ($parameter->isDefaultValueAvailable()) {
                $carry[$parameterName] = $parameter->getDefaultValue();
            }

            return $carry;
        }, []);
    }
}