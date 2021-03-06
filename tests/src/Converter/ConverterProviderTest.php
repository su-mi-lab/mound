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
            ->endRule
            ->rule('test_data2')
            ->attach(Converter\Rules\Trim::class)
            ->endRule
            ->rule('test_data3')
            ->attach(Converter\Rules\Trim::class)
            ->endRule;

        $data = $provider->exec($data);

        $this->assertEquals($data['test_data1'], 'test_data1');
        $this->assertEquals($data['test_data2'], 'test_data2');
        $this->assertEquals($data['test_data3'], 'test_data3');
    }

    function testConverterProvider()
    {
        $provider = new Converter\Provider;

        $data = [
            'test_data1' => 'test_data1',
        ];

        $provider
            ->rule('test_data1')
            ->attach(Converter\Rules\Callback::class, [
                'callback' => function ($val, $context) {
                    return 'callback';
                }
            ])
            ->endRule;

        $data = $provider->exec($data);

        $this->assertEquals($data['test_data1'], 'callback');
    }
}