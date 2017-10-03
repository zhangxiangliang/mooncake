<?php

namespace Zhangxiangliang\Mooncake\Traits;

use Exception;

trait RuleValidateTrait
{
    /**
     * 用于检查 参数是否为数组 并进行错误抛出
     */
    private function validateIsArray($arr)
    {
        if(!is_array($arr)) {
            throw new Exception("请检查参数是否为数组");
        }
    }

    /**
     * 用于检查 所有规则 是否存在于 Field 名中
     */
    private function validateRulesFieldName($rule)
    {
        $keys = collect($this->config['rules'])->keys();
        foreach ($rules as $ruleName => $rule) {
            if(!$keys->containt($ruleName)) {
                throw new Exception("请检查配置文件是否有该规则名");
            };
        }
    }

    /**
     * 用于检查 所有规则 是否都实现了 Rule 接口
     */
    private function checkRulesInterface($rules)
    {
        foreach ($rules as $rules) {
            if(!$this->checkRuleInterface()) {
                throw new Exception('请检查规则是否实现了 Rule 接口');
            }
        }
    }

    /**
     * 用于检查 单个规则 是否实现了 Rule 接口
     * @return false
     */
    private function checkRuleInterface($rule)
    {
        return $rule instanceof Rule;
    }
}
