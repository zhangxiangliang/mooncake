<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\HeiLiuBoRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class HeiLiuBoRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new HeiLiuBoRule;
        $this->dices = [
            [2, 2, 2, 2, 2, 2],
            [3, 3, 3, 3, 3, 3],
            [5, 5, 5, 5, 5, 5],
            [6, 6, 6, 6, 6, 6],
        ];
    }

    public function test_hei_liu_bo_rule_validate_true()
    {
        foreach ($this->dices as $dice) {
            $passed = $this->rule->validate($dice);
            $level = $this->rule->getLevel();
            $this->assertEquals($passed, true);
            $this->assertEquals($level, 900+$dice[0]*10);
        }
    }

    public function test_hei_liu_bo_rule_validate_false()
    {
        foreach (range(1, 10) as $r) {
            $dices = random_array(1, 6, 6);
            if(!in_array($dices, $this->dices)) {
                $passed = $this->rule->validate($dices);
                $this->assertEquals($passed, false);
            }
        }
    }
}
