<?php

use Mound\Filter\Rules\Callback;

class CallbackFilterTest extends TestCase
{

    function testAllowCallbackFilter()
    {
        $filter = new Callback(function ($val, $context) {
            return $val == 2;
        });
        $this->assertEquals($filter->call(2), true);
    }

    function testDenyCallbackFilter()
    {
        $filter = new Callback(function ($val, $context) {
            return $val == 2;
        });
        $this->assertEquals($filter->call(1), false);
    }

}