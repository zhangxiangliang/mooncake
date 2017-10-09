<?php

namespace Zhangxiangliang\Mooncake\Tests\Unit;

use Zhangxiangliang\Mooncake\Contracts\Rule;
use Zhangxiangliang\Mooncake\RuleManager;
use Zhangxiangliang\Mooncake\Rules\ChaJinHuaRule;
use Zhangxiangliang\Mooncake\Rules\ManTangHongRule;
use Zhangxiangliang\Mooncake\Tests\TestCase;

class RuleMangerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->manager = new RuleManager;
    }

    public function test_get_null_rules()
    {
        $passed = $this->manager->getRules();
        $this->assertEquals($passed, []);
    }

    public function test_get_chajinghua_rules()
    {
        $this->manager->setRules(['chajinghua' => new ChaJinHuaRule]);
        $rules = $this->manager->getRules();
        $passed = isset($rules['chajinghua']);
        $this->assertEquals($passed, true);
    }

    public function test_get_default_name()
    {
        $passed = $this->manager->getName();
        $this->assertEquals($passed, config('mooncake.default.name'));
    }

    public function test_get_cha_jing_hua_name()
    {
        $this->manager->setRules(['chajinghua' => new ChaJinHuaRule]);
        $this->manager->setDices([4, 4, 4, 4, 1, 1]);
        $passed = $this->manager->getName();

        $this->assertEquals($passed, config('mooncake.rules.chajinhua.name'));
    }

    public function test_get_default_alias_name()
    {
        $passed = $this->manager->getAliasName();
        $this->assertEquals($passed, config('mooncake.default.alias_name'));
    }

    public function test_get_man_tang_hong_alias_name()
    {
        $this->manager->setRules(['mantanghong' => new ManTangHongRule]);
        $this->manager->setDices([4, 4, 4, 4, 4, 4]);
        $passed = $this->manager->getAliasName();
        $this->assertEquals($passed, config('mooncake.rules.mantanghong.alias_name'));
    }

    public function test_get_default_field_name()
    {
        $passed = $this->manager->getFieldName();
        $this->assertEquals($passed, config('mooncake.default.field_name'));
    }

    public function test_get_man_tang_hong_field_name()
    {
        $this->manager->setRules(['mantanghong' => new ManTangHongRule]);
        $this->manager->setDices([4, 4, 4, 4, 4, 4]);
        $passed = $this->manager->getFieldName();
        $this->assertEquals($passed, config('mooncake.rules.mantanghong.field_name'));
    }

    public function test_get_default_level()
    {
        $passed = $this->manager->getLevel();
        $this->assertEquals($passed, config('mooncake.default.level'));
    }

    public function test_get_man_tang_hong_level()
    {
        $this->manager->setRules(['mantanghong' => new ManTangHongRule]);
        $this->manager->setDices([4, 4, 4, 4, 4, 4]);
        $passed = $this->manager->getLevel();
        $this->assertEquals($passed, config('mooncake.rules.mantanghong.level'));
    }

    public function test_get_default_point()
    {
        $passed = $this->manager->getPoint();
        $this->assertEquals($passed, config('mooncake.default.point'));
    }

    public function test_get_man_tang_hong_point()
    {
        $this->manager->setRules(['mantanghong' => new ManTangHongRule]);
        $this->manager->setDices([4, 4, 4, 4, 4, 4]);
        $passed = $this->manager->getPoint();
        $this->assertEquals($passed, config('mooncake.rules.mantanghong.point'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请设置塞子的值
     */
    public function test_get_null_dices()
    {
        $passed = $this->manager->getDices();
    }

    public function test_get_cha_jing_hua_dices()
    {
        $this->manager->setRules(['chajinghua' => new ChaJinHuaRule]);
        $this->manager->setDices([1, 4, 1, 4, 4, 4]);
        $passed = $this->manager->getDices();
        $this->assertEquals($passed, [4, 4, 4, 4, 1, 1]);
    }

    public function test_get_default_rule_config()
    {
        $passed = $this->manager->getRuleConfig();
        $this->assertEquals($passed, config("mooncake.rules"));
    }

    public function test_get_man_tang_hong_rule_config()
    {
        $passed = $this->manager->getRuleConfig('mantanghong');
        $this->assertEquals($passed, config("mooncake.rules.mantanghong"));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查规则名称是否存在
     */
    public function test_get_undefined_rule_config()
    {
        $passed = $this->manager->getRuleConfig('star');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查参数是否为数组
     */
    public function test_validate_is_not_array()
    {
        $this->manager->validateRules('star');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查配置文件是否有该规则名
     */
    public function test_validate_is_not_in_rules_filed_name()
    {
        $this->manager->validateRules(['start' => 'hello']);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage 请检查规则是否实现了 Rule 接口
     */
    public function test_validate_is_not_interface_rule()
    {
        $this->manager->validateRules(['mantanghong' => 'hello']);
    }
}
