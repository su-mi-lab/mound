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
     * @var string
     */
    protected $message = "can't be blank";

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