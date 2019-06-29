<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-29
 * Time: 21:45
 */

namespace App\Services;
use App\Room;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;


class RoomService
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
    public function addRoom(Room $room): bool
    {
        $sql = DB::raw('INSERT INTO Rooms (Name, Description) VALUES (:Name, :Description)');
        $results = DB::insert($sql,
            ['Name' => $room->getName(), 'Description' => $room->getDescription()]);
        return $results;

    }

}
