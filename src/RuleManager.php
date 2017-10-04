<?php

namespace Zhangxiangliang\Mooncake;

use Zhangxiangliang\Mooncake\Contracts\Rule;
use Zhangxiangliang\Mooncake\Traits\RuleConfigTrait;
use Zhangxiangliang\Mooncake\Traits\RuleIteratorTrait;
use Zhangxiangliang\Mooncake\Traits\RuleValidateTrait;

class RuleManager
{
    protected $rules;
    protected $config;

    use RuleConfigTrait;
    use RuleValidateTrait;
    use RuleIteratorTrait;

    public function __construct(array $rules = [])
    {
        $this->checkRulesInterface($rules);
        $this->rules = $rules;
        $this->setConfig(config('mooncake'));
    }

    /**
     * 获取 当前规则 官名
     * @return string
     */
    public function getName()
    {
        return $this->ruleIterator('getName', $this->getConfigDefault('name'));
    }

    /**
     * 获取 当前规则 别名
     */
    public function getAliasName()
    {
        return $this->ruleIterator('getAliasName', $this->getConfigDefault('alias_name'));
    }

    /**
     * 获取 当前规则 字段名
     */
    public function getFieldName()
    {
        return $this->ruleIterator('getFieldName', $this->getConfigDefault('field_name'));
    }

    /**
     * 获取 当前规则 级别
     */
    public function getLevel()
    {
        return $this->ruleIterator('getLevel', $this->getConfigDefault('level'));
    }

    /**
     * 获取 当前规则 积分
     * @return int
     */
    public function getPoint()
    {
        return $this->ruleIterator('getPoint', $this->getConfigDefault('point'));
    }

    /**
     * 获取 格式化 骰子
     * @return array
     */
    public function getDices()
    {
        return $this->ruleIterator('formatDices', $this->dices, [$this->dices]);
    }

    /**
     * 获取 规则 相关信息
     * @return array
     */
    public function getRuleConfig($name)
    {
        return config("mooncake.rules.{$name}");
    }

    /**
     * 获取 所有规则 实例
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
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
     * 设置 规则数组
     */
    public function setRules($rules)
    {
        $this->validateIsArray($rules);
        $this->validateRulesFieldName($rules);
        $this->checkRulesInterface($rules);

        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }
}
