<?php

namespace Mound\Validator;

use Mound\RuleInterface;

/**
 * Class AbstractValidator
 * @package Mound\Validator
 */
abstract class AbstractValidator implements RuleInterface, ValidatorRuleInterface
{

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var bool
     */
    protected $valid = true;


    /**
     * @param $value
     * @return bool
     */
    public function call($value): bool
    {
        $this->valid = true;
        return $this->validate($value);
    }

    /**
     * @return string|null
     */
    public function message()
    {
        if ($this->valid) {
            return null;
        }

        return $this->message;
    }

    /**
     * @param $value
     * @return bool
     */
    abstract protected function validate($value): bool;
}