<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\ErJuRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class ErJuRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new ErJuRule;
    }

    public function test_er_ju_rule_validate_true()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateRepeatDices(4, 2);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_er_ju_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateLimitDices(4, 2);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }
}
