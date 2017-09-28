<?php

namespace Zhangxiangliang\Mooncake\Contracts;

interface Rule
{
    /**
     * 验证 骰子数组 基本规范
     * @param $dices
     * @return boolen
     */
    public function validate(array $dices);

    /**
     * 获取 当前规则 官名
     * @return string
     */
    public function getName();

    /**
     * 获取 当前规则 别名
     * @return string
     */
    public function getAliasName();

    /**
     * 获取 当前规则 字段名
     */
    public function getFeildName();

    /**
     * 获取 当前规则 级别
     * @return int
     */
    public function getLevel();

    /**
     * 获取 当前规则 积分
     * @return int
     */
    public function getPoint();

    /**
     * 验证是否满足 当前规则
     * @return boolen
     */
    public function rule(array $dices);

    /**
     * 获取 格式化 骰子
     * @return array
     */
    public function formatDice(array $dices);

    /**
     * 用于初始化 $name, $aliasName, $level, $point
     */
    public function setupConfig();
}
