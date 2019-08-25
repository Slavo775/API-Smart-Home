<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:38
 */

namespace App\Http\Controllers;


use App\Exceptions\ipAdressIsNotValidException;
use App\Services\DeviceService;
use App\Services\ValidationService;
use App\Device;
use Illuminate\Http\JsonResponse;
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

    /**
     * This method recieve ip address of device. Send request on this IP.
     * Response is all information abou device this information set on model device and insert to database.
     * @param DeviceService $device
     * @param ValidationService $validation
     * @param Request $request
     * @return JsonResponse
     */
    public function addDeviceIp(DeviceService $device, ValidationService $validation, Request $request){

        $data = json_decode($request->getContent());

        try{
            $json = file_get_contents('http://'. $data->IP .':8080/deviceStatus');
        }catch (\Exception $ex){
            return response()->json(['status' => 'false', 'message' => 'Wrong IP or device down']);
        }
        $jsonDecode = json_decode($json);
        try{
           $validation->validateIPAddress($jsonDecode->ip);
        }
        catch (ipAdressIsNotValidException $ex){
            return response()->json(['status' => 'false' , 'message' => $ex->getMessage()]);
        }

        if(!empty($jsonDecode->mac)){
            $result = $device->findDeviceByMac($jsonDecode->mac);
            if(empty($result['status'])){
                return response()->json(['status' => 'false' , 'message' => 'Device exist in database with ip '.$result['ip'][0]->ip]);
            }
        }
        if(isset($jsonDecode->name)
            && isset($jsonDecode->type)
            && isset($jsonDecode->role)
            && isset($jsonDecode->mac)
            && isset($jsonDecode->ip)
            && isset($jsonDecode->description)){
            $postDevice = new Device();
            $postDevice->setName($jsonDecode->name);
            $postDevice->setTypeOfDevice($jsonDecode->type);
            $postDevice->setRole($jsonDecode->role);
            $postDevice->setMac($jsonDecode->mac);
            $postDevice->setIPAdress($jsonDecode->ip);
            $postDevice->setDescription($jsonDecode->description);
            $status = $device->addDevice($postDevice);
            if(!empty($status)){
                return response()->json(['status' => 'ok']);
            }
            return response()->json(['status' => 'false', 'message' => 'Cannot insert to database']);
        }
        return response()->json(['status' => 'false', 'message' => 'Parameters is not correct!']);
    }
}
