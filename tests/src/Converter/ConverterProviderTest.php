<?php

use Mound\Converter;

class ConverterProviderTest extends TestCase
{
    function testSimpleConverterProvider()
    {
        $provider = new Converter\Provider;

        $data = [
            'test_data1' => ' test_data1',
            'test_data2' => 'test_data2 ',
            'test_data3' => '　test_data3　'
        ];

        $provider
            ->rule('test_data1')
            ->attach(Converter\Rules\Trim::class)
            ->end
            ->rule('test_data2')
            ->attach(Converter\Rules\Trim::class)
            ->end
            ->rule('test_data3')
            ->attach(Converter\Rules\Trim::class)
            ->end;

        $data = $provider->exec($data);

        $this->assertEquals($data['test_data1'], 'test_data1');
        $this->assertEquals($data['test_data2'], 'test_data2');
        $this->assertEquals($data['test_data3'], 'test_data3');
    }
}