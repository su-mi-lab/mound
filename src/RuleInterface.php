<?php

namespace Mound;

/**
 * Interface RuleInterface
 * @package Mound
 */
interface RuleInterface
{

    /**
     * @param $value
     * @param array $context
     * @return mixed
     */
    public function call($value, array $context);
}