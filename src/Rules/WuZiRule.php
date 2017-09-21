<?php

namespace Zhangxiangliang\Mooncake\Rules;

class WuZiRule extends RuleAbstract
{
    protected $name = '状元';
    protected $alias = '五子';
    protected $level = 700;
    protected $baseLevel = 700;

    public function rule(array $dices)
    {
        // 判断是否有 5 个一样的骰子
        $count = array_count_values($dices);
        $keys = array_keys($count, 5);
        $key = array_pop($keys);
        if($key === null || $key === 4) return false;

        // 计算分数
        $this->level = $this->baseLevel + $key * 10;

        // 获取只有 1 个的骰子
        $keys = array_keys($count, 1);
        $key = array_pop($keys);

        // 计算分数
        $this->level = $this->level + $key;
        return true;
    }
}


