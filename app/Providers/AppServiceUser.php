<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 15:23
 */

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceUser extends ServiceProvider
{

    public  function register()
    {
        $this->app->bind('App\Services\UserService', function ($app) {
            return new UserService();
        });

    }
}
