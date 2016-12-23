<?php


use Mound\Validator;

class ProviderTest extends TestCase
{
    function test()
    {
        $this->assertEquals(true, true);
    }

    function testValidateProvider()
    {
        $provider = new Validator\Provider();

        $data = [
            'test_data1' => '',
            'test_data2' => 'test_data2',
            'test_data3' => ''
        ];

        $provider
            ->rule('test_data1')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->rule('test_data2')
            ->attach(\Mound\Validator\Rules\NotEmpty::class)
            ->rule('test_data3')
            ->attach(\Mound\Validator\Rules\NotEmpty::class);

        $error = $provider->exec($data);

        $this->assertEquals(isset($error['test_data1']), true);
        $this->assertEquals(isset($error['test_data2']), false);
        $this->assertEquals(isset($error['test_data3']), true);
    }
}