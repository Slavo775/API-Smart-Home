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
use phpDocumentor\Reflection\Types\Array_;

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

    /**
     * return all unresolved status
     * @return array
     */
    public function getAllStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false];
        }
        return ['result' => $result];
    }

    /**
     * return all unresolved error
     * @return array
     */
    public function getErrorStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0 AND sl.status_type = 1');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true, 'result' => $result];
    }

    /**
     * return all unresolved warnings
     * @return array
     */
    public function getWarningStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0 AND sl.status_type = 2');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true, 'result' => $result];
    }
    /**
     * return all actual info
     *@return array
     */
    public function getInfoStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0 AND sl.status_type = 3');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true, 'result' => $result];
    }

}
