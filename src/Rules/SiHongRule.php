<?php

namespace Zhangxiangliang\Mooncake\Rules;

class SiHongRule extends RuleAbstract
{
    protected $ruleName = 'sihong';

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 4);
        if(!in_array(4, $keys)) return false;

        $keys = array_diff($dices, [4]);
        $this->levelResult = $this->level;
        foreach ($keys as $key) $this->levelResult += $key;
        return true;
    }
}


