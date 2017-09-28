<?php

namespace Zhangxiangliang\MoonCake;

class RuleManager
{
    protected $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * 设置骰子
     */
    public function setDices(array $dices)
    {
        $this->dices = $dices;
        return $this;
    }

    /**
     * 获取 当前规则 官名
     * @return string
     */
    public function getName()
    {
        return $this->ruleIterator('getName', config('mooncake.default.name'));
    }

    /**
     * 获取 当前规则 别名
     */
    public function getAliasName()
    {
        return $this->ruleIterator('getAliasName', config('mooncake.default.alias_name'));
    }

    /**
     * 获取 当前规则 字段名
     */
    public function getFeildName()
    {
        return $this->ruleIterator('getFeildName', config('mooncake.default.field_name'));
    }

    /**
     * 获取 当前规则 级别
     */
    public function getLevel()
    {
        return $this->ruleIterator('getLevel', config('mooncake.default.level'));
    }

    /**
     * 获取 当前规则 积分
     * @return int
     */
    public function getPoint()
    {
        return $this->ruleIterator('getPoint', config('mooncake.default.point'));
    }

    /**
     * 获取 格式化 骰子
     * @return array
     */
    public function getDices()
    {
        return $this->ruleIterator('formatDice', $this->dices, [$this->dices]);
    }

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
