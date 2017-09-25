<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\YiXiuRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class YiXiuRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new YiXiuRule;
    }

    public function test_yi_xiu_rule_validate_true()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateRepeatDices(4, 1);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_yi_xiu_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateLimitDices(4, 1);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }
}
