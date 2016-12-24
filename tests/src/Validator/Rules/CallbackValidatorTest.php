<?php

use Mound\Validator\Rules\Callback;

class CallbackValidatorTest extends TestCase
{

    function testCallbackValidator()
    {
        $validator = new Callback("error", function ($val, $context) {
            return (bool)$val;
        });

        $this->assertEquals($validator->call(1), true);

        $validator = new Callback("error", function ($val, $context) {
            return (bool)$val;
        });

        $this->assertEquals($validator->call(''), false);
    }

}