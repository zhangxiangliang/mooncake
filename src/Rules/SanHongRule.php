<?php

namespace Zhangxiangliang\Mooncake\Rules;

class SanHongRule extends RuleAbstract
{
    protected $ruleName = 'sanhong';

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 3);

        return in_array(4, $keys);
    }
}


