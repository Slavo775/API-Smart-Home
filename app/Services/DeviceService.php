<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 22:49
 */

namespace App\Services;


use App\Device;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class DeviceService
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
     *This function save data of device to table Device
     * @param array $device
     * @return bool
     */
    public function addDevice(Device $device): bool
    {
        $sql = DB::raw('INSERT INTO device (name, ip,  mac, description, type) VALUES ( :nam, :IP, :mac, :descr, :Type)');
        $results = DB::insert($sql,
            ['Type' => $device->getTypeOfDevice(), 'IP' => $device->getIPAdress(), 'nam' => $device->getName(), 'descr' => $device->getDescription(), 'mac' => $device->getMac() ]);
        return $results;

    }

    /**
     * @param string $mac
     * @return array
     */
    public function findDeviceByMac(string $mac){
        $sql = DB::raw('SELECT ip FROM device WHERE mac = :mac');
        $result = DB::select($sql,
            ['mac' => $mac]);
        if(!empty($result)){
            return ['status' => false, 'ip' => $result];
        }
        return ['status' => 'ok'];
    }

    /**
     * @return array
     */
    public function findAllDevice(){
        $sql = DB::raw('SELECT * FROM device');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false];
        }
        return ['result' => $result];
    }

    /**
     * @return array
     */
    public function findAllActiveDevice(){
        $sql = DB::raw('SELECT * FROM device WHERE active = 1');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false, 'result' => null];
        }
        return ['result' => $result, 'status' => $result];
    }

    /**
     * @return array
     */
    public function findAllNonactiveDevice(){
        $sql = DB::raw('SELECT * FROM device WHERE active = 0');
        $result = DB::select($sql);
        if(empty($result)){
            return ['status' => false, 'result' => null];
        }
        return ['status' => true ,'result' => $result];
    }

    /**
     * set status of device
     * @param Device $device
     * @return array
     */
    public function setActiveStatus(Device $device){
        $sql = DB::raw('UPDATE device SET active = :active WHERE id_device = :id_device');
        $bind = ['active' => $device->isActive(), 'id_device' => $device->getIDDevice()];
        $result = DB::update($sql, $bind);
        if(empty($result)){
            return ['status' => false];
        }
        return ['status' => true];
    }


}
