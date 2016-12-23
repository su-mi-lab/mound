<?php

namespace Mound\Validator\Rules;

use Mound\Validator\AbstractValidator;

/**
 * Class NotEmpty
 * @package Mound\Validator\Rules
 */
class NotEmpty extends AbstractValidator
{

    /**
     * NotEmpty constructor.
     * @param string $message
     * @param array $groups
     */
    function __construct($message = "can't be blank", $groups = [])
    {
        $this->message = $message;
        $this->groups = $groups;
    }

    /**
     * @param $value
     * @return bool
     * @throws \Exception
     */
    protected function validate($value): bool
    {

        if (!is_scalar($value) && !is_null($value)) {
            throw new \Exception('invalid value in NotEmpty.');
        }

        if ($value === null || $value === '') {
            $this->valid = false;
        }

        return $this->valid;
    }
}