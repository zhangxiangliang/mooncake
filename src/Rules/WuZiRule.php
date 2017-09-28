<?php

namespace Zhangxiangliang\Mooncake\Rules;

class WuZiRule extends RuleAbstract
{
    protected $ruleName = 'wuzi';

    public function rule(array $dices)
    {
        // 判断是否有 5 个一样的骰子
        $count = array_count_values($dices);
        $keys = array_keys($count, 5);
        $key = array_pop($keys);
        if($key === null || $key === 4) return false;

        // 计算分数
        $this->levelResult = $this->level + $key * 10;

        // 获取只有 1 个的骰子
        $keys = array_keys($count, 1);
        $key = array_pop($keys);

        // 计算分数
        $this->levelResult = $this->levelResult + $key;
        return true;
    }

    public function formatDices(array $dices)
    {
        // 判断是否有 5 个一样的骰子
        $count = array_count_values($dices);
        $keys = array_keys($count, 5);
        $max = array_pop($keys);

        $keys = array_keys($count, 1);
        $min = array_pop($keys);
        return [$max, $max, $max, $max, $max, $min];
    }
}


