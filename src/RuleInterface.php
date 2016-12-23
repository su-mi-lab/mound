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
     * @return mixed
     */
    public function call($value);
}