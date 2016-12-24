<?php

use Mound\Validator\Rules\InArray;

class InArrayValidatorTest extends TestCase
{

    private $haystack = [1, '1', 1.0];

    function testInArrayValidator()
    {
        $validator = new InArray("is invalid", $this->haystack);

        $this->assertEquals($validator->call(''), false);
        $this->assertEquals($validator->call(null), false);
        $this->assertEquals($validator->call(0), false);
        $this->assertEquals($validator->call('1'), true);
        $this->assertEquals($validator->call(1), true);
        $this->assertEquals($validator->call(1.0), true);
    }

    function testInArrayValidatorMessage()
    {
        $validator = new InArray("is invalid", $this->haystack);
        $validator->call('');
        $this->assertEquals($validator->message(), "is invalid");

    }
}