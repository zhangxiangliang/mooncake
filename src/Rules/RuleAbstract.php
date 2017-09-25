<?php

namespace Zhangxiangliang\Mooncake\Rules;

use Exception;
use Zhangxiangliang\Mooncake\Contracts\Rule;

class RuleAbstract implements Rule
{
    /**
     * Rule name
     */
    protected $name;

    /**
     * Rule level
     */
    protected $level;

    /**
     * Rule alias
     */
    protected $alias;

    /**
     * Dice Array, Length is Six
     */
    protected $dices;

    /**
     * 初始化 规则配置
     */
    public function __construct()
    {
        $this->setupConfig();
    }

    /**
     * 验证 骰子数组 基本规范
     * @return boolen
     */
    public function validate(array $dices)
    {
        if(count($dices) !== 6) {
            throw new Exception("骰子数组的长度不为6");
        }

        foreach ($dices as $dice) {
            if($dice < 0 || $dice > 6) {
                throw new Exception("骰子的点数不在 1 到 6 的范围里");
            }
        }

        return $this->rule($dices);
    }

    /**
     * 获取 当前规则 官名
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 获取 当前规则 别名
     */
    public function getAliasName()
    {
        return $this->aliasName;
    }

    /**
     * 获取 当前规则 字段名
     */
    public function getFeildName()
    {
        return $this->feildName;
    }

    /**
     * 获取 当前规则 级别
     */
    public function getLevel()
    {
        return $this->levelResult;
    }

    /**
     * 获取 当前规则 积分
     * @return int
     */
    public function getPoint()
    {
        return $this->point();
    }

    /**
     * 验证是否满足 当前规则
     * @return boolen
     */
    public function rule(array $dices)
    {
        sort($dices);
        sort($this->dices);
        return $this->dices === $dices;
    }

    /**
     * 用于初始化 $name, $aliasName, $level, $point
     */
    public function setupConfig()
    {
        $ruleName = $this->ruleName;
        $baseName = "mooncake.rules.{$ruleName}.";

        foreach (['name', 'point', 'alias_name', 'level', 'point', 'field_name'] as $key) {
            $camelCase = camel_case($key);
            $this->$camelCase = config($baseName . $key);
        }

        $this->levelResult = $this->level;
    }
}
