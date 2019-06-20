<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 22:49
 */

namespace App\Services;


use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class DeviceService
{

    /**
     *This function save data of device to table Device
     * @param array $device
     * @return bool
     */
    public function addDevice(array $device): bool
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

        $sql = DB::raw('INSERT INTO Device (Type_of_device, role, location, IP_adress, name, Description) VALUES (:Type, :role, :location, :IP, :nam, :descr)');
        $results = DB::insert($sql,
            ['Type' => $device['type'], 'role' => $device['role'], 'location' => $device['location'], 'IP' => $device['IP'], 'nam' => $device['name'], 'descr' => $device['description']]);
        return $results;

    }


}
