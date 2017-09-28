<?php

namespace Zhangxiangliang\Mooncake\Rules;

class DuiTangRule extends RuleAbstract
{
    protected $dices = [1, 2, 3, 4, 5, 6];
    protected $ruleName = 'duitang';

    public function formatDices(array $dices)
    {
        sort($dices);
        return $dices;
    }
}
