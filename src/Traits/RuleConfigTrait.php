<?php

namespace Zhangxiangliang\Mooncake\Traits;

use Exception;

trait RuleConfigTrait
{
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
