<?php

use Mound\Filter\Rules\NotEmpty;

class NotEmptyFilterTest extends TestCase
{

    function testAllowNotEmptyFilter()
    {
        $filter = new NotEmpty;
        $this->assertEquals($filter->call(1), true);
        $this->assertEquals($filter->call(0), true);
        $this->assertEquals($filter->call('1'), true);
        $this->assertEquals($filter->call('0'), true);
        $this->assertEquals($filter->call(['1']), true);
    }

    function testDenyNotEmptyFilter()
    {
        $filter = new NotEmpty;
        $this->assertEquals($filter->call(''), false);
        $this->assertEquals($filter->call(null), false);
        $this->assertEquals($filter->call([]), false);
    }

}