<?php

namespace SamLittler\LaravelVero;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use SamLittler\Vero\Vero;

class VeroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Vero::class, function ($app) {
            return new Vero(self::config('auth_token'));
        });

        $this->app->bind('vero', function () {
            return $this->app->make(Vero::class);
        });
    }

    private static function config($key) : string
    {
        $key = 'services.vero.' . $key;

        return Config::get($key);
    }
}
