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
        $sql = DB::raw('INSERT INTO device (type, role, mac, ip, name, description) VALUES (:Type, :role, :mac, :IP, :nam, :descr)');
        $results = DB::insert($sql,
            ['Type' => $device->getTypeOfDevice(), 'role' => $device->getRole(), 'location' => $device->getMac(), 'IP' => $device->getIPAdress(), 'nam' => $device->getName(), 'descr' => $device->getDescription()]);
        return $results;

    }


}
