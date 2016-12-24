<?php

use Mound\Validator;

class ValidateProviderTest extends TestCase
{
    function testSimpleValidateProvider()
    {
        $provider = new Validator\Provider;

        $data = [
            'test_data1' => '',
            'test_data2' => 'test_data2',
            'test_data3' => ''
        ];

        $provider
            ->rule('test_data1')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->endRule
            ->rule('test_data2')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->attach(\Mound\Validator\Rules\InArray::class, [
                'haystack' => ['test_data2']
            ])
            ->endRule
            ->rule('test_data3')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->endRule;

        $error = $provider->exec($data);

        $this->assertEquals(isset($error['test_data1']), true);
        $this->assertEquals(isset($error['test_data2']), false);
        $this->assertEquals(isset($error['test_data3']), true);
    }

    function testGroupValidateProvider()
    {
        $provider = new Validator\Provider;

        $haystack = ['test_data'];
        $data = [
            'test_data1' => 'test_data1',
            'test_data2' => 'test_data2'
        ];

        $provider
            ->rule('test_data1')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->endRule
            ->rule('test_data2')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->endRule
            ->group('in_array')
            ->rule('test_data1')
            ->attach(\Mound\Validator\Rules\InArray::class, [
                'haystack' => $haystack
            ])
            ->endRule
            ->rule('test_data2')
            ->attach(\Mound\Validator\Rules\InArray::class, [
                'haystack' => $haystack
            ])
            ->endRule
            ->endGroup;

        $error = $provider->exec($data);
        $this->assertEquals((bool)$error, false);

        $error = $provider->exec($data, ['in_array']);
        $this->assertEquals((bool)$error, true);
    }
}