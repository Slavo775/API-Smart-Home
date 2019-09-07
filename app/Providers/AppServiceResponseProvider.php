<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-09-07
 * Time: 18:21
 */

namespace App\Providers;


use App\Services\ResponseService;
use Illuminate\Support\ServiceProvider;

class AppServiceResponseProvider extends ServiceProvider
{

    public  function register()
    {
        $this->app->bind('App\Services\DeviceService', function ($app) {
            return new ResponseService();
        });

    }

}
