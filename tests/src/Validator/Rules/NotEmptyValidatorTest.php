<?php

use Mound\Injection;
use Mound\Validator\Rules\NotEmpty;

class NotEmptyValidatorTest extends TestCase
{

    function testNotEmptyValidator()
    {
        $validator = new NotEmpty();

        $this->assertEquals($validator->call(''), false);
        $this->assertEquals($validator->call(null), false);
        $this->assertEquals($validator->call(0), true);
        $this->assertEquals($validator->call('test'), true);
        $this->assertEquals($validator->call('0'), true);
    }

    function testNotEmptyValidatorMessage()
    {
        $validator = new NotEmpty();
        $validator->call('');
        $this->assertEquals($validator->message(), "can't be blank");

        $validator = new NotEmpty();
        $validator->call('test');
        $this->assertEquals($validator->message(), null);
    }

    function testCustomMessage()
    {
        $options = [
            'message' => 'test'
        ];

        $injection = new Injection('Mound\Validator\Rules\NotEmpty');
        $validator = $injection->newInstance($options);

        $validator->call('');
        $this->assertEquals($validator->message(), "test");
    }

}