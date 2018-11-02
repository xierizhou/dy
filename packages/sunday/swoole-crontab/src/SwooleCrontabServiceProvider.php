<?php

namespace Sunday\SwooleCrontab;

use Illuminate\Support\ServiceProvider;

class SwooleCrontabServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = false; // 延迟加载服务


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/Config/swoole_crontab.php' => config_path('swoole_crontab.php'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigs();
        $this->registerCommands();

        // 单例绑定服务
        $this->app->singleton('crontab', function ($app) {

            return new Crontab($app['session'], $app['config']);
        });

    }

    /**
     * Merge config.
     */
    protected function mergeConfigs()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/swoole_crontab.php', 'swoole_crontab');
    }


    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands([
            SwooleCrontabCommand::class,
        ]);
    }



}
