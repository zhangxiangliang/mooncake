<?php

namespace Zhangxiangliang\Mooncake\Rules;

class SiJinRule extends RuleAbstract
{
    protected $name = '进士';
    protected $alias = '四进';
    protected $level = 300;

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 4);

        return !in_array(4, $keys) && count($keys) === 1;
    }
}