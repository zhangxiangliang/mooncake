<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Rules\ChaJinHuaRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class ChaJinHuaRuleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rule = new ChaJinHuaRule;
    }

    /**
     * 验证 状元插金花
     */
    public function test_cha_jin_hua_validate_true()
    {
        $dices = [1, 1, 4, 4, 4, 4];
        $passed = $this->rule->validate($dices);
        $this->assertEquals($passed, true);
    }

    /**
     * 验证除了 状元插金花 之外的规则
     */
    public function test_cha_jin_hua_validate_false()
    {
        $target = [1, 1, 4, 4, 4, 4];
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
