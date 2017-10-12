<?php

namespace Zhangxiangliang\Mooncake;

use Exception;
use Zhangxiangliang\Mooncake\Contracts\Rule;

class RuleManager
{
    protected $rules;
    protected $config;

    public function __construct(array $rules = [])
    {
        $this->setConfig(config('mooncake'));
        $this->validateRules($rules);
        $this->setRules($rules);
    }


    public function getResult()
    {
        return collect([
            'name' => $this->getName(),
            'alias_name' => $this->getAliasName(),
            'field_name' => $this->getFieldName(),
            'level' => $this->getLevel(),
            'point' => $this->getPoint(),
        ]);
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
        if(!isset($this->dices)) {
            throw new Exception('请设置塞子的值');
        }
        return $this->ruleIterator('formatDices', $this->dices, [$this->dices]);
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
     * 用于检查 规则是否符合要求
     * @param  [type] $rules [description]
     * @return [type]        [description]
     */
    public function validateRules($rules)
    {
        $this->validateIsArray($rules);
        $this->validateRulesFieldName($rules);
        $this->checkRulesInterface($rules);
    }

    /**
     * 用于检查 参数是否为数组 并进行错误抛出
     */
    public function validateIsArray($rules)
    {
        if(!is_array($rules)) {
            throw new Exception("请检查参数是否为数组");
        }
    }

    /**
     * 用于检查 所有规则 是否存在于 Field 名中
     */
    public function validateRulesFieldName($rules)
    {
        $keys = collect($this->getConfigRules())->keys();
        foreach ($rules as $ruleName => $rule) {
            if(!$keys->contains($ruleName)) {
                throw new Exception("请检查配置文件是否有该规则名");
            };
        }
    }

    /**
     * 用于检查 所有规则 是否都实现了 Rule 接口
     */
    public function checkRulesInterface($rules)
    {
        foreach ($rules as $rule) {
            if(!$this->checkRuleInterface($rule)) {
                throw new Exception('请检查规则是否实现了 Rule 接口');
            }
        }
    }

    /**
     * 用于检查 单个规则 是否实现了 Rule 接口
     * @return false
     */
    public function checkRuleInterface($rule)
    {
        return $rule instanceof Rule;
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

    /**
     * 设置 规则数组
     */
    public function setRules($rules)
    {
        if(!isset($this->rules)) $this->rules = [];
        $this->rules = array_merge($this->rules, $rules);
        return $this;
    }

    /**
     * 获取 config 变量
     */
    public function getConfig()
    {
        if(!isset($this->config)) {
            throw new Exception("请检查 相关配置文件 是否存在");
        }
        return $this->config;
    }

    /**
     * 设置 config 变量
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * 获取默认配置名
     */
    public function getConfigDefault($name = '')
    {
        if ($name == '') {
            return $this->config['default'];
        }

        if (!isset($this->config['default'][$name])) {
            throw new Exception("请检查 相关配置文件 的默认配置是否存在");
        }

        return $this->config['default'][$name];
    }

    /**
     * 获取默认规则
     */
    public function getConfigRules($name = '')
    {
        if ($name == '') {
            return $this->config['rules'];
        }

        if (!isset($this->config['rules'][$name])) {
            throw new Exception("请检查 相关配置文件 的规则配置是否存在");
        }

        return $this->config['rules'][$name];
    }
}
