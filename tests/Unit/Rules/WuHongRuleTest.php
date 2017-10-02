<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit\Rules;

use Zhangxiangliang\Mooncake\Rules\WuHongRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class WuHongRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new WuHongRule;
    }

    public function test_wu_hong_rule_validate_true()
    {
        foreach (range(1, 10) as $i) {
            $dices = $this->generateRepeatDices(4, 5);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_wu_hong_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices =$this->generateLimitDices(4, 5);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }

    public function test_wu_hong_level()
    {
        $passed = $this->rule->validate([4, 4, 4, 4, 4, 2]);
        $level = $this->rule->getLevel();
        $this->assertEquals($passed, true);
        $this->assertEquals($level, 820);
    }
}
