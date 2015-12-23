<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Cache\CacheManager;
use TADPHP\TADFactory;
// use Cache;


class TADServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $options = [
            'ip' => '192.168.1.201',
            'internal_id' => 1,
            'com_key' => 0,
            'soap_port' => 80,
            'udp_port' => 4370,
            'encoding' => 'utf-8',    // iso8859-1 by default.
            'connection_timeout' => 2
        ];

        // $this->app->instance('TADF',$this->app->make('TADPHP\TADFactory', [$options])->get_instance());

        $this->app->bind('TADF', 'TADPHP\TADFactory', function($app)
        {
            return new TADPHP\TADFactory($options);
        });

    }
}
