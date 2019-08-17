<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:21
 */

namespace App\Services;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\DB;

class StatusService
{
    public function __construct()
    {
        /**
         * Setup a new app instance container
         *
         * @var Container
         */
        $app = Container::getInstance();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);
    }

    public function getAllStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false];
        }
        return ['result' => $result];
    }

}
