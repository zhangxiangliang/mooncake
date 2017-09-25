<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\WuZiRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class WuZiRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new WuZiRule;
    }

    public function test_wu_zi_rule_validate_true()
    {
        foreach (range(1, 6) as $i) {
            if($i == 4) continue;
            $dices = $this->generateRepeatDices($i, 5);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_wu_zi_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices =$this->generateRepeatDices(4, 5);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }

    public function test_wu_zi_level()
    {
        $passed = $this->rule->validate([5, 5, 5, 5, 5, 2]);
        $level = $this->rule->getLevel();
        $this->assertEquals($passed, true);
        $this->assertEquals($level, 752);
    }
}
