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

        $name = $request->post('name');
        $type = $request->post('type');
        $role = $request->post('role');
        $location = $request->post('location');
        $ipAdress = $request->post('IP_adress');
        $description = $request->post('description');
        $status = $request->post('status');

        if(isset($name)
            && isset($type)
            && isset($role)
            && isset($location)
            && isset($ipAdress)
            && isset($description)
            && isset($status)) {
            $postDevice = new Device();
            $postDevice->setName($name);
            $postDevice->setTypeOfDevice($type);
            $postDevice->setRole($role);
            $postDevice->setLocation($location);
            $postDevice->setIPAdress($ipAdress);
            $postDevice->setDescription($description);
            $postDevice->setStatus($status);
            $device->addDevice($postDevice);
            return response()->json(['status' => 'true']);
        }

        return response()->json(['status' => 'false']);
    }
}
