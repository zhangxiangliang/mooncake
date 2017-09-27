<?php

namespace Zhangxiangliang\MoonCake;

class RuleManager
{
    protected $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

}
