<?php

namespace Zhangxiangliang\Mooncake\Rules;

class YiXiuRule extends RuleAbstract
{
    protected $name = '秀才';
    protected $alias = '一秀';
    protected $level = 100;

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 1);

        return in_array(4, $keys);
    }
}
