<?php

namespace Mound\Validator;

/**
 * Interface ValidatorRuleInterface
 * @package Mound\Validator
 */
interface ValidatorRuleInterface
{

    /**
     * @return string|null
     */
    public function message();
}