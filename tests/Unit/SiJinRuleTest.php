<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\SiJinRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class SiJinRuleTest extends TestCase
{
    public function setUp()
    {
        $this->rule = new SiJinRule;
    }

    public function test_si_jin_rule_validate_true()
    {
        foreach ([1, 2, 3, 5, 6] as $item) {
            foreach (range(1, 10) as $r) {
                $dices = $this->generateRepeatDices($item, 4);
                $passed = $this->rule->validate($dices);
                $this->assertEquals($passed, true);
            }
        }
    }

    public function test_si_jin_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = $this->generateLimitDices(4, 4);

            $count = array_count_values($dices);
            $keys = array_keys($count, 4);
            if($keys !== []) continue;

            $passed = $this->rule->validate($dices);
            $this->assertEquals($passed, false);
        }
    }
}
