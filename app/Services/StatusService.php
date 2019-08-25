<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:21
 */

namespace App\Services;

use App\Status;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class StatusService
{
    private const statusText = [
        1 => 'Zariadenie nie je dosiahnuteľné',
        2 => 'Zariadenie nebolo dosiahnuteľné',
        3 => 'Neznáma chyba',
    ];
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
        $results = DB::select($sql);
        if(empty($results)){
            return ['status' => false, 'result' => null];
        }
        foreach ($results as $key => $result){
            $results[$key]->status_code = $this->getStatusText($result->status_code);
        }
        return ['status' => true, 'result' => $results];
    }

    /**
     * return all unresolved warnings
     * @return array
     */
    public function getWarningStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0 AND sl.status_type = 2');
        $results = DB::select($sql);
        if(empty($results)){
            return ['status' => false, 'result' => null];
        }
        foreach ($results as $key => $result){
            $results[$key]->status_code = $this->getStatusText($result->status_code);
        }
        return ['status' => true, 'result' => $results];
    }
    /**
     * return all actual info
     *@return array
     */
    public function getInfoStatus(){
        $sql = DB::raw('SELECT * FROM status_log sl INNER JOIN device d ON sl.id_device = d.id_device WHERE sl.resolved = 0 AND sl.status_type = 3');
        $results = DB::select($sql);
        if(empty($results)){
            return ['status' => false, 'result' => null];
        }
        foreach ($results as $key => $result){
            $results[$key]->status_code = $this->getStatusText($result->status_code);
        }
        return ['status' => true, 'result' => $results];
    }

    /**
     * return status text from status code
     * @param int $statusCode
     * @return mixed|string
     */
    private function getStatusText(int $statusCode){
        return isset(StatusService::statusText[$statusCode]) ? StatusService::statusText[$statusCode] : 'Neznáma chyba!';
    }

    /**
     * set column resolved value 1 of current status
     * @param Status $status
     * @return bool
     */
    public function setResolvedStatus(Status $status){
        $sql = DB::raw('UPDATE status_log SET resolved = 1 WHERE id_status = :id_status');
        $result = DB::update($sql, ['id_status' => $status->getIdStatus()]);
        if(!empty($result)){
            return true;
        }
        return false;
    }

}
