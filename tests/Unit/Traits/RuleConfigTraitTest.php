<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit\Traits;

use Mockery;
use Zhangxiangliang\Mooncake\Traits\RuleConfigTrait;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class Mock { use RuleConfigTrait; }

class RuleConfigTraitTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mock = new Mock;
        $this->mock->setConfig(config('mooncake'));
    }

    public function test_get_config()
    {
        $passed = $this->mock->getConfig();
        $this->assertEquals($passed, config('mooncake'));
    }

    public function test_get_default_name()
    {
        $passed = $this->mock->getConfigDefault('name');
        $name = config('mooncake.default.name');
        $this->assertEquals($passed, $name);
    }

    public function test_get_default_config()
    {
        $passed = $this->mock->getConfigDefault();
        $default = config('mooncake.default');
        $this->assertEquals($passed, $default);
    }

    public function test_get_yixiu_rules()
    {
        $passed = $this->mock->getConfigRules('yixiu');
        $rule = config('mooncake.rules.yixiu');
        $this->assertEquals($passed, $rule);
    }

    public function test_get_rules_config()
    {
        $passed = $this->mock->getConfigRules();
        $rules = config('mooncake.rules');
        $this->assertEquals($passed, $rules);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查 相关配置文件 是否存在
     */
    public function test_get_none_exist_config()
    {
        $mock = new Mock;
        $mock->getConfig();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查 相关配置文件 的默认配置是否存在
     */
    public function test_get_none_exist_default_name()
    {
        $mock = new Mock;
        $mock->getConfigDefault('hello');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查 相关配置文件 的规则配置是否存在
     */
    public function test_get_none_exist_rules()
    {
        $mock = new Mock;
        $mock->getConfigRules('hello');
    }
}
