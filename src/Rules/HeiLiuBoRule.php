<?php

namespace Zhangxiangliang\Mooncake\Rules;

class HeiLiuBoRule extends RuleAbstract
{
    protected $ruleName = 'heiliubo';

    public function rule(array $dices)
    {
        $uniques = array_unique($dices);
        if(count($uniques) != 1) return false;

        $unique = array_pop($uniques);
        $keys = array_keys([2, 3, 5, 6], $unique);
        if($keys === []) return false;

        $this->levelResult = $this->level + $unique * 10;
        return true;
    }
}
