<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-23
 * Time: 09:52
 */

namespace App\Providers;



use App\Services\ValidationService;
use Illuminate\Support\ServiceProvider;

class AppServiceValidation extends ServiceProvider
{

    public  function register()
    {
        $this->app->bind('App\Services\ValidationService', function ($app) {
            return new ValidationService();
        });

    }

}
