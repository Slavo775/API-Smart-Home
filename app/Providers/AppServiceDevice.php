<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:14
 */

namespace App\Providers;



use App\Services\DeviceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceDevice extends ServiceProvider
{
    public  function register()
    {
        $this->app->bind('App\Services\DeviceService', function ($app) {
            return new DeviceService();
        });

    }
}
