<?php

namespace Zhangxiangliang\Mooncake\Rules;

class WuHongRule extends RuleAbstract
{
    protected $name = '状元';
    protected $alias = '五红';
    protected $level = 800;
    protected $baseLevel = 800;

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 5);

        if(!in_array(4, $keys)) return false;

        $keys = array_keys($count, 1);
        $key = array_pop($keys);
        $this->level = $this->baseLevel + $key * 10;

        return true;
    }
}
