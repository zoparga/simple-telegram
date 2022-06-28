<?php

namespace zoparga\SimpleTelegram;

use Illuminate\Support\ServiceProvider;

class SimpleTelegramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('simpletelegram', function ($app) {
            return new SimpleTelegram();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/simpletelegram.php' => config_path('simpletelegram.php'),
            ], 'config');
        }
    }
}
