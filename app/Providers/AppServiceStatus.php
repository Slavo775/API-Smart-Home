<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:24
 */

namespace App\Providers;


use App\Services\StatusService;
use Carbon\Laravel\ServiceProvider;

class AppServiceStatus extends ServiceProvider
{
    public  function register()
    {
        $this->app->bind('App\Services\StatusService', function ($app) {
            return new StatusService();
        });

    }

}
