<?php

namespace Zhangxiangliang\Mooncake\Traits;

trait RuleIteratorTrait
{
    /**
     * 用于调用骰子方法
     * @param  匹配到相应规则时，要调用的方法
     * @param  没有匹配到相应规则时，返回默认值
     * @param  调用的方法需要的参数
     */
    private function ruleIterator($method, $default, $arguments = null)
    {
        foreach ($this->rules as $rule) {
            if ($rule->validate($this->dices)) {
                return $arguments
                    ? $rule->$method(...$arguments)
                    : $rule->$method();
            }
        }
        return $default;
    }
}
