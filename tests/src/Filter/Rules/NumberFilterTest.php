<?php


use Mound\Filter\Rules\Number;

class NumberFilterTest extends TestCase
{

    function testAllowNotEmptyFilter()
    {
        $filter = new Number();
        $this->assertEquals($filter->call(1), true);
        $this->assertEquals($filter->call(1.1), true);
        $this->assertEquals($filter->call('1'), true);
        $this->assertEquals($filter->call('1.1'), true);
    }

    function testDenyNotEmptyFilter()
    {
        $filter = new Number;
        $this->assertEquals($filter->call(''), false);
        $this->assertEquals($filter->call(null), false);
        $this->assertEquals($filter->call('test'), false);
    }

}