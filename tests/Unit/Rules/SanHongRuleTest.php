<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit\Rules;

use Zhangxiangliang\Mooncake\Rules\SanHongRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class SanHongRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new SanHongRule;
    }

    public function test_san_hong_rule_validate_true()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateRepeatDices(4, 3);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, true);
        }
    }

    public function test_san_hong_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateLimitDices(4, 3);
            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }
}
