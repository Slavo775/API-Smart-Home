<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:38
 */

namespace App\Http\Controllers;


use App\Providers\AppServiceDevice;
use App\Services\DeviceService;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Container\Container;

class Device extends Controller
{

    public function addDevice(DeviceService $device){
        $postDevice = [
            'type' => 'Arduino',
            'role' => 'garden',
            'location' => 'location',
            'IP' => 'IP',
            'name' => 'arduinko',
            'description' => 'silny popis'
         ];
        $device->addDevice($postDevice);
        return response()->json($postDevice);

    }
}
