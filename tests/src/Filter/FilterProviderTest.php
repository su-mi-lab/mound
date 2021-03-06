<?php

use Mound\Filter;

class FilterProviderTest extends TestCase
{
    function testSimpleFilterProvider()
    {
        $provider = new Filter\Provider;

        $data = [
            'test_data1' => '',
            'test_data2' => 'test_data2',
            'test_data3' => ''
        ];

        $provider
            ->rule('test_data1')
            ->attach(Filter\Rules\NotEmpty::class)
            ->endRule
            ->rule('test_data2')
            ->attach(Filter\Rules\NotEmpty::class)
            ->endRule
            ->rule('test_data3')
            ->attach(Filter\Rules\NotEmpty::class)
            ->endRule;


        $data = $provider->exec($data);

        $this->assertEquals(isset($data['test_data1']), false);
        $this->assertEquals(isset($data['test_data2']), true);
        $this->assertEquals(isset($data['test_data3']), false);
    }

    function testFilterProvider()
    {
        $provider = new Filter\Provider;

        $data = [
            'test_data1' => '1',
            'test_data2' => '2',
        ];

        $provider
            ->rule('test_data1')
            ->attach(Filter\Rules\Callback::class, [
                'callback' => function ($val, $context) {
                    return $val == 2;
                }
            ])
            ->endRule
            ->rule('test_data2')
            ->attach(Filter\Rules\Callback::class, [
                'callback' => function ($val, $context) {
                    return $val == 2;
                }
            ])
            ->endRule;


        $data = $provider->exec($data);

        $this->assertEquals(isset($data['test_data1']), false);
        $this->assertEquals(isset($data['test_data2']), true);
    }
}