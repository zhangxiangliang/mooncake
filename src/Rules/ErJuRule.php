<?php

namespace Zhangxiangliang\Mooncake\Rules;

class ErJuRule extends RuleAbstract
{
    protected $name = '举人';
    protected $alias = '二举';
    protected $level = 200;

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 2);
        return in_array(4, $keys);
    }
}
