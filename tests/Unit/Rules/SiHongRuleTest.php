<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit\Rules;

use Zhangxiangliang\Mooncake\Rules\SiHongRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class SiHongRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new SiHongRule;
    }

    public function test_si_hong_rule_validate_true()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateRepeatDices(4, 4);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_si_hong_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateLimitDices(4, 4);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }

    public function test_si_hong_level()
    {
        $passed = $this->rule->validate([4, 4, 4, 4, 5, 1]);
        $level = $this->rule->getLevel();
        $this->assertEquals($passed, true);
        $this->assertEquals($level, 606);
    }
}
