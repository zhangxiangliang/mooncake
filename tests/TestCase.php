<?php

namespace Zhangxiangliang\Mooncake\Tests;

use Orchestra\Testbench\TestCase as TestCaseBase;

class TestCase extends TestCaseBase
{
    protected function getPackageAliases($app)
    {
        return [
            'config' => 'Illuminate\Config\Repository'
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $mooncake = require realpath(__DIR__ . '/../src/config.php');
        $app['config']->set('mooncake', $mooncake);
    }

    /**
     * 用户生成随机骰子数组
     * @return array
     */
    public function generateDices()
    {
        return random_array(1, 6, 6);
    }

    /**
     * 生成需要重复随机骰子
     * @param  int $special 需要重复的数字
     * @param  int $times  需要重复的次数
     * @return array
     */
    public function generateRepeatDices($special, $times)
    {
        $count = 0;
        $dices = [];
        while($count < 6 - $times)
        {
            $rand = random_int(1, 6);
            if($special === $rand) continue;

            $count++;
            array_push($dices, $rand);
        }


        foreach (range(1, $times) as $item) {
            array_push($dices, $special);
        }

        return $dices;
    }

    /**
     * 生成需要限制的随机骰子
     * @param  int $special 需要限制的数字
     * @param  int $times  需要限制的次数
     * @return array
     */
    public function generateLimitDices($special, $times)
    {
        $count = 0;
        $dices = [];

        while($count < 6) {
            $rand = random_int(1, 6);
            if($rand === $special && $times == 1) continue;

            $counts = array_count_values($dices);
            $keys = array_keys($counts, $times-1);
            if(in_array($special, $keys) && $rand === $special) continue;

            $count++;
            array_push($dices, $rand);
        }
        return $dices;
    }
}
