<?php

namespace Mound\Validator\Rules;

use Mound\Validator\AbstractValidator;

class Callback extends AbstractValidator
{
    private $callback;

    /**
     * Callback constructor.
     * @param $message
     * @param $callback
     */
    function __construct($message, $callback)
    {
        $this->message = $message;
        $this->callback = $callback;
    }

    /**
     * @param $value
     * @return bool
     * @throws \Exception
     */
    protected function validate($value): bool
    {
        if (!is_scalar($value) && !is_null($value)) {
            throw new \Exception('invalid value in Callback.');
        }
        $callable = $this->callback;
        $this->valid = (bool)$callable($value, $this->context);
        return $this->valid;
    }
}