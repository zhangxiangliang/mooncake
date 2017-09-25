<?php

namespace Zhangxiangliang\Mooncake\Rules;

class ErJuRule extends RuleAbstract
{
    protected $ruleName = 'erju';

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 2);
        return in_array(4, $keys);
    }
}
