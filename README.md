# 博饼规则验证器

## 基础要求
* PHP > 5.6
* Laravel >= 5.0

## 安装
```
composer require "zhangxiangliang/mooncake:~1.0" -vvv
```

## 配置

1.注册 `ServiceProvider`
```
Zhangxiangliang\Mooncake\ServiceProvider::class,
```

2.创建配置文件
```
php artisan vendor:publish --provider="Zhangxiangliang\Mooncake\ServiceProvider"
```

## 使用

### 快速教程
```php
// 获取实例
$rule = app('MooncakeRule');

// 设置骰子，骰子的值需要自己生成
$rule = $rule->setDices([1, 2, 3, 4, 5, 6]);

// 获取骰子结果，返回值为 collect 类型
$result = $rule->setDices([1, 2, 3, 4, 5, 6])->getResult();

// 获取骰子官名，例如 状元、榜眼、探花等，具体看 `config/mooncake.php` 中的 rules
$name = $rule->setDices([1, 2, 3, 4, 5, 6])->getName();

// 获取骰子别名，例如 插金花、满堂红等，具体看 `config/mooncake.php` 中的 rules
$aliasName = $rule->setDices([1, 2, 3, 4, 5, 6])->getAliasName();

// 获取骰子字段名，例如 chajinhua、mantanghong 等，方便数据存储和转换 `config/mooncake.php` 中的 rules
$fieldName = $rule->setDices([1, 2, 3, 4, 5, 6])->getFieldName();

// 获取骰子的等级，用于比较骰子之间值的大小，具体看 `config/mooncake.php` 中的 rules
$level = $rule->setDices([1, 2, 3, 4, 5, 6])->getLevel();

// 获取骰子的积分，具体看 `config/mooncake.php` 中的 rules
$point = $rule->setDices([1, 2, 3, 4, 5, 6])->getPoint();
```

### 可用接口

#### 简介
* 接口中除了 `get` 开头的方法外，均会返回 `$this` 方便链式调用。
* 官名、别名、字段名、等级、积分可以在 `config/mooncake.php` 中设置。

#### 骰子相关
* `setDices($dices)` 设置骰子的值，需要自己生成值。
* `getDices()` 获取骰子的值，会将骰子的值格式化后返回，格式化规则 除了特殊的 对堂、四进、五子 外，4 优先排序其他数值降序排列。

#### 结果相关
* `getName()` 获取官名。
* `getAliasName()` 获取别名。
* `getFieldName()` 获取字段名。
* `getLevel()` 获取等级，等级用于判断 骰子值的大小。
* `getPoint()` 获取积分，积分可以用于记录用户博饼的分值。
* `getResult()` 获取结果，结果为 `collection` 包含了官名、别名、字段名、等级、积分。

#### 规则/配置相关
* `getConfig()` 获取 所有配置。
* `getRules()` 获取 所有规则 对象数组。
* `setRules($rules)` 动态 添加规则 对象。
* `getConfigRules($name)` 获取 规则相关配置，如果无参则返回规则列表。
* `getConfigDefault($name)` 获取 默认相关配置，如果无参则返回默认相关列表。

## 项目相关
### 简单流程
![简单流程](/assets/images/flow.png)
