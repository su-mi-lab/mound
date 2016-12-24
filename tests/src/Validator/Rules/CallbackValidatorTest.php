<?php

use Mound\Validator\Rules\Callback;

class CallbackValidatorTest extends TestCase
{

    function testInArrayValidator()
    {
        $validator = new Callback("error", function ($val, $context) {
            return (bool)$val;
        });

        $this->assertEquals($validator->call(1), true);
    }

    function testInArrayValidatorMessage()
    {
        $validator = new Callback("error", function ($val, $context) {
            return (bool)$val;
        });

        $this->assertEquals($validator->call(''), false);

    }
}