<?php

namespace Zhangxiangliang\Mooncake\Traits;

trait RuleConfigTrait
{
    /**
     * 设置 config 变量
     */
    private function getConfig()
    {
        return config('mooncake');
    }

    /**
     * 获取默认配置名
     */
    private function getConfigDefault($name = '')
    {
        return $name
            ? $this->config['default'][$name]
            : $this->config['default'];
    }

    /**
     * 获取默认规则
     */
    private function getConfigRules($name = '')
    {
        return $name
            ? $this->config['rules'][$name]
            : $this->config['rules'];
    }
}
