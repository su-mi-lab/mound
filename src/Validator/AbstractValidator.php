<?php

namespace Mound\Validator;

use Mound\RuleInterface;

/**
 * Class AbstractValidator
 * @package Mound\Validator
 */
abstract class AbstractValidator implements RuleInterface
{

    /**
     * @param $value
     * @return mixed
     */
    public function call($value)
    {
        return $value;
    }
}