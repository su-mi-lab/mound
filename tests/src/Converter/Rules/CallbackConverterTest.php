<?php

use Mound\Converter\Rules\Callback;

class CallbackConverterTest extends TestCase
{

    function testCallbackConverter()
    {
        $converter = new Callback(function ($val, $context) {
            return '';
        });

        $this->assertEquals($converter->call(' 1 '), '');
    }

}