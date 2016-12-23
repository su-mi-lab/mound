<?php

use Mound\Filter\Rules\NotEmptyFilter;

class NotEmptyFilterTest extends TestCase
{

    function testAllowNotEmptyFilter()
    {
        $filter = new NotEmptyFilter;
        $this->assertEquals($filter->call(1), true);
        $this->assertEquals($filter->call(0), true);
        $this->assertEquals($filter->call('1'), true);
        $this->assertEquals($filter->call('0'), true);
        $this->assertEquals($filter->call(['1']), true);
    }

    function testDenyNotEmptyFilter()
    {
        $filter = new NotEmptyFilter;
        $this->assertEquals($filter->call(''), false);
        $this->assertEquals($filter->call(null), false);
        $this->assertEquals($filter->call([]), false);
    }

}