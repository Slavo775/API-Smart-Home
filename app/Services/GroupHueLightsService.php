<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-28
 * Time: 21:03
 */

namespace App\Services;

use App\Device;
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

    public function setActiveStatus( GroupHueLights $groupHueLights){
        $sql = DB::raw('UPDATE group_hue_lights SET active = :active WHERE id_group = :id_device');
        $bind = ['active' => $groupHueLights->isActive(), 'id_device' => $groupHueLights->getIdGroup()];
        $result = DB::update($sql, $bind);
        if(empty($result)){
            return ['status' => false];
        }
        return ['status' => true];
    }
}
