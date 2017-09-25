<?php

namespace Zhangxiangliang\Mooncake\Rules;

class WuHongRule extends RuleAbstract
{
    protected $ruleName = 'wuhong';

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 5);

        if(!in_array(4, $keys)) return false;

        $keys = array_keys($count, 1);
        $key = array_pop($keys);
        $this->levelResult = $this->level + $key * 10;

        return true;
    }
}
