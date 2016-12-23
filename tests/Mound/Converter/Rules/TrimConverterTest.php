<?php

use Mound\Converter\Rules\TrimConverter;

class TrimConverterTest extends TestCase
{

    function testTrimConverter()
    {
        $converter = new TrimConverter;

        $this->assertEquals($converter->call(' 1 '), '1');
        $this->assertEquals($converter->call(' 1'), '1');
        $this->assertEquals($converter->call('1  '), '1');
        $this->assertEquals($converter->call('　日本語　　'), '日本語');
        $this->assertEquals($converter->call('　日本　語　'), '日本　語');
    }


}