<?php

namespace Zhangxiangliang\Mooncake\Rules;

class SiHongRule extends RuleAbstract
{
    protected $name = '状元';
    protected $alias = '四红';
    protected $level = 600;
    protected $baseLevel = 600;

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 4);
        if(!in_array(4, $keys)) return false;

        $keys = array_keys($count, 1);
        $this->level = $this->baseLevel;
        foreach ($keys as $key) $this->level += $key;
        return true;
    }
}


