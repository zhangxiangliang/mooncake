<?php

namespace Zhangxiangliang\MoonCake;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupConfig();
        $this->registerManager();
    }

    /**
     * 配置初始化
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/config.php');

        // 添加配置文件到 publish
        if ($this->app instanceof LaravelApplication) {
            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $source => config_path('mooncake.php')
                ]);
            }
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('mooncake');
        }

        // 加载配置文件到 $this->app['config']
        $this->mergeConfigFrom($source, 'mooncake');
    }

    /**
     * 注册管理类
     */
    protected function registerManager()
    {
        $rules = $this->generatorRules();
        $this->app->singleton('MooncakeRule', function() use ($rules) {
            return new RuleManager($rules);
        });
    }

    /**
     * 规则数组生成
     */
    protected function generatorRules()
    {
        $rules = [];
        $config = $this->app['config']['mooncake']['rules'];

        foreach ($config as $key => $rule) {
            $rules[] = new $rule['class'];
        }

        return $rules;
    }
}
