<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-28
 * Time: 21:03
 */

namespace App\Services;

use App\Device;
use App\Exceptions\invalidArrayKeyException;
use App\GroupHueLights;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class GroupHueLightsService
{
    public function __construct()
    {
        /**
         * Setup a new app instance container
         *
         * @var Illuminate\Container\Container
         */
        $app = Container::getInstance();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);
    }

    /**
     * @return array
     */
    public function getAllActiveGroups(){
        $sql = DB::raw('SELECT ghl.id_group as id_device, ghl.name, ghl.id_group as ip, ghl.active  FROM group_hue_lights ghl WHERE active = 1');
        $results = DB::select($sql);
        foreach($results as $key => $result){
            $results[$key]->mac = '-';
            $results[$key]->description = '-';
            $results[$key]->type = 'Group';
        }
        if(empty($results)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true ,'result' => $results];
    }

    /**
     * @return array
     */
    public function getAllNonActiveGroups(){
        $sql = DB::raw('SELECT ghl.id_group as id_device, ghl.name, ghl.id_group as ip, ghl.active  FROM group_hue_lights ghl WHERE active = 0');
        $results = DB::select($sql);
        foreach($results as $key => $result){
            $results[$key]->mac = '-';
            $results[$key]->description = '-';
            $results[$key]->type = 'Group';
        }
        if(empty($results)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true ,'result' => $results];
    }

    /**
     * @param GroupHueLights $groupHueLights
     * @return array
     */
    public function setActiveStatus( GroupHueLights $groupHueLights){
        $sql = DB::raw('UPDATE group_hue_lights SET active = :active WHERE id_group = :id_device');
        $bind = ['active' => $groupHueLights->isActive(), 'id_device' => $groupHueLights->getIdGroup()];
        $result = DB::update($sql, $bind);
        if(empty($result)){
            return ['status' => false];
        }
        return ['status' => true];
    }

    /**
     * @return array
     * @throws invalidArrayKeyException
     */
    public function getGroupsWithDevices(){
        $sql = DB::raw('SELECT * FROM group_hue_lights WHERE active = 1');
        $result = DB::select($sql);
        try{$result = $this->fillArray($result, 'id_from_bridge');}
        catch (invalidArrayKeyException $ex){
            return ['status' => false, 'message' => $ex->getMessage()];
        }

        $this->getInfoFromBridge($result);
        return ['result' => $result];
    }

    /**
     * @param array $groups
     */
    private function getInfoFromBridge(array &$groups){
        $hueContent = file_get_contents('http://192.168.31.36/api/AH7Or1g7rXJhJbOwv1VEDA-kPLra6O-JAu3waKqk/groups/');
        $hueJson = json_decode($hueContent);
        foreach($hueJson as $key => $json){
            if(!isset($groups[$key])){
                continue;
            }
            $groups[$key]->on = $json->action->on;
            $groups[$key]->bri = $json->action->bri;
            $groups[$key]->lights = $this->getHueByIp($json->lights);
        }
    }

    /**
     * @param array $array
     * @param string $array_key
     * @return array
     * @throws invalidArrayKeyException
     */
    private function fillArray(array $array, string $array_key){
        $new_array = [];
        foreach($array as $item){
            if(!isset($item->$array_key)){
                throw new invalidArrayKeyException('Key not exist in array');
            }
            $new_array[$item->$array_key] = $item;
        }
        return $new_array;
    }

    /**
     * @param array $lights
     * @return array
     */
    private function getHueByIp(array $lights){
        $result_lights = [];
        foreach($lights as $light){
            $sql = DB::raw('SELECT * FROM device WHERE active = 1 AND ip = :ip');
            $bind = ['ip' => $light];
            $result = DB::select($sql, $bind);
            if(!isset($result)){
                continue;
            }
            $hueContent = file_get_contents('http://192.168.31.36/api/AH7Or1g7rXJhJbOwv1VEDA-kPLra6O-JAu3waKqk/lights/'.$light);
            $lightJson = json_decode($hueContent);
            $result[0]->on = $lightJson->state->on;
            $result[0]->bri = $lightJson->state->bri;
            $result[0]->reachable = $lightJson->state->reachable;
            $result_lights[$light] = $result[0];
        }
        return $result_lights;
    }
}
