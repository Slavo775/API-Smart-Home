<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:38
 */

namespace App\Http\Controllers;


use App\Exceptions\ipAdressIsNotValidException;
use App\Providers\AppServiceDevice;
use App\Services\DeviceService;
use App\Services\ValidationService;
use Carbon\Laravel\ServiceProvider;
use App\Device;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    /**
     *this function validate and add device to the database
     *@param DeviceService $device
     *@param ValidationService $validate
     *@param Request $request
     *@return \Illuminate\Http\JsonResponse
     */
    public function addDevice(DeviceService $device, ValidationService $validate , Request $request) :\Illuminate\Http\JsonResponse
    {
        $data = json_decode($request->getContent());
        $name = $data->name;
        $type = $data->type;
        $role = $data->role;
        $location = $data->location;
        $IP_address = $data->IP;
        $description = $data->description;
        try{
            $IP_address = $validate->validateIPAddress($IP_address);
        }
        catch (ipAdressIsNotValidException $ex){
           return response()->json(['status' => 'false' , 'message' => $ex->getMessage()]);
        }
        if(isset($name)
            && isset($type)
            && isset($role)
            && isset($location)
            && isset($IP_address)
            && isset($description)) {
            $postDevice = new Device();
            $postDevice->setName($name);
            $postDevice->setTypeOfDevice($type);
            $postDevice->setRole($role);
            $postDevice->setLocation($location);
            $postDevice->setIPAdress($IP_address);
            $postDevice->setDescription($description);
//            $postDevice->setStatus($status);
            $device->addDevice($postDevice);
            return response()->json(['status' => 'true']);
        }

        return response()->json(['status' => 'false', 'message' => 'Please fill all field!']);

    }
}
