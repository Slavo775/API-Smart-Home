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
use App\Device;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    public function addDevice(DeviceService $device, Request $request){


        $postDevice = new Device();
        $postDevice->setName($request->post('name'));
        $postDevice->setTypeOfDevice($request->post('type'));
        $postDevice->setRole($request->post('role'));
        $postDevice->setLocation($request->post('location'));
        $postDevice->setIPAdress($request->post('IP_adress'));
        $postDevice->setDescription($request->post('description'));
        $postDevice->setStatus('status');

        $device->addDevice($postDevice);
        return response()->json($postDevice);

    }
}
