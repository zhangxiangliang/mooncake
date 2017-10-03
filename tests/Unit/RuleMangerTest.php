<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Contracts\Rule;
use Zhangxiangliang\Mooncake\RuleManager;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class RuleMangerTest extends TestCase
{
    public function setUp()
    {
        $this->manager = new RuleManager;
    }

    public function test_get_rules()
    {
        $passed = $this->manager->getRules();
        $this->assertEquals($passed, []);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查参数是否为数组
     */
    public function test_set_rules_is_not_array()
    {
        $rule = new RuleManager;
        $passed = $this->manager->setRules($rule);
    }
}
