<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-28
 * Time: 21:02
 */

namespace App\Providers;

use App\GroupHueLights;
use Illuminate\Support\ServiceProvider;

class AppServiceGroupHueLights extends ServiceProvider
{
    public  function register()
    {
        $this->app->bind('App\Services\GroupHueLightService', function ($app) {
            return new GroupHueLights();
        });

    }
}
