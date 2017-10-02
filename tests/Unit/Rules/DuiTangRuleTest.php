<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit\Rules;

use Zhangxiangliang\Mooncake\Rules\DuiTangRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class DuiTangRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new DuiTangRule;
    }

    public function test_dui_tang_validate_true()
    {
        $dices = [1, 2, 3, 4, 5, 6];
        $passed = $this->rule->validate($dices);
        $this->assertEquals($passed, true);
    }

    public function test_dui_tang_validate_false()
    {
        $target = [1, 2, 3, 4, 5, 6];
        foreach (range(1, 10) as $r) {
            $dices = $this->generateDices();
            sort($dices);
            if ($dices !== $target) {
                $passed = $this->rule->validate($dices);
                $this->assertEquals($passed, false);
            }
        }
    }
}
