<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 15:23
 */

namespace App\Providers;

use App\Services\ExerciseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceExercise extends ServiceProvider
{
    public  function register()
    {
        $this->app->bind('App\Services\ExerciseService', function ($app) {
            return new ExerciseService();
        });

    }
}
