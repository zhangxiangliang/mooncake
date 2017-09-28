<?php

namespace Zhangxiangliang\Mooncake\Rules;

class SiJinRule extends RuleAbstract
{
    protected $ruleName = 'sijin';

    public function rule(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 4);

        return !in_array(4, $keys) && count($keys) === 1;
    }

    public function formatDices(array $dices)
    {
        $count = array_count_values($dices);
        $keys = array_keys($count, 4);
        $key = array_pop($keys);

        $result = [$key, $key, $key, $key];
        $diffs = array_diff($dices, [$key]);
        rsort($diffs);

        $result = array_merge($result, $diffs);
        return $result;
    }
}
