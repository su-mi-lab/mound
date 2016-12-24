<?php

namespace Mound\Validator\Rules;

use Mound\Validator\AbstractValidator;

/**
 * Class InArray
 * @package Mound\Validator\Rules
 */
class InArray extends AbstractValidator
{

    /**
     * @var array
     */
    private $haystack = [];

    /**
     * InArray constructor.
     * @param string $message
     * @param array $haystack
     */
    function __construct($message = "is invalid", array $haystack)
    {
        $this->message = $message;
        $this->haystack = $haystack;
    }

    /**
     * @param $value
     * @param array $context
     * @return bool
     * @throws \Exception
     */
    protected function validate($value, array $context): bool
    {

        if (!is_scalar($value) && !is_null($value)) {
            throw new \Exception('invalid value in InArray.');
        }

        if (!in_array($value, $this->haystack)) {
            $this->valid = false;
        }

        return $this->valid;
    }
}