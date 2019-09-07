<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:38
 */

namespace App\Http\Controllers;


use App\Exceptions\ipAdressIsNotValidException;
use App\GroupHueLights;
use App\Services\DeviceService;
use App\Services\GroupHueLightsService;
use App\Services\ResponseService;
use App\Services\StatusService;
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
     *@param ResponseService $responseService
     *@return \Illuminate\Http\JsonResponse
     */
    public function addDevice(DeviceService $device, ValidationService $validate , Request $request, ResponseService $responseService) :\Illuminate\Http\JsonResponse
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
           return response()->json($responseService->createErrorResponse(ResponseService::CODE_INVALID_IP, $ex->getMessage()));
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
            return response()->json($responseService->createSuccessResponse(['result' => 'success']));
        }

        return response()->json($responseService->createErrorResponse(ResponseService::CODE_EMPTY_INPUT, ResponseService::EMPTY_INPUT_MESSAGE));

    }

    /**
     * This method recieve ip address of device. Send request on this IP.
     * Response is all information abou device this information set on model device and insert to database.
     * @param DeviceService $device
     * @param ValidationService $validation
     * @param Request $request
     * @param ResponseService $responseService
     * @return JsonResponse
     */
    public function addDeviceIp(DeviceService $device, ValidationService $validation, Request $request, ResponseService $responseService){

        $data = json_decode($request->getContent());

        try{
            $json = file_get_contents('http://'. $data->IP .':8080/deviceStatus');
        }catch (\Exception $ex){
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_DEVICE_NOT_REACHABLE, ResponseService::DEVICE_NOT_REACHABLE));
        }
        $jsonDecode = json_decode($json);
        try{
           $validation->validateIPAddress($jsonDecode->ip);
        }
        catch (ipAdressIsNotValidException $ex){
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_INVALID_IP, $ex->getMessage()));
        }

        if(!empty($jsonDecode->mac)){
            $result = $device->findDeviceByMac($jsonDecode->mac);
            if(empty($result['status'])){
                return response()->json($responseService->createErrorResponse(ResponseService::CODE_DEVICE_EXIST_IN_DATABASE, ResponseService::DEVICE_EXIST_IN_DATABASE_MESSAGE . $result['ip'][0]->ip . '!'));
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
                return response()->json($responseService->createSuccessResponse(['result' => 'success']));
            }
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_CANNOT_INSERT_TO_DATABASE, ResponseService::CODE_CANNOT_INSERT_TO_DATABASE));
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_DATA_IS_INCORRECT, ResponseService::DATA_IS_EMPTY_MESSAGE));
    }

    /**
     * this function get all active and nonactive devices
     * @param DeviceService $deviceService
     * @param GroupHueLightsService $groupHueLightsService
     * @param ResponseService $responseService
     * @return JsonResponse
     */
    public function allDevice(GroupHueLightsService $groupHueLightsService, DeviceService $deviceService, ResponseService $responseService){
        $resultActive = $deviceService->findAllActiveDevice();
        $resultNonactive = $deviceService->findAllNonactiveDevice();
        $resultActiveGroup = $groupHueLightsService->getAllActiveGroups();
        $resultNonactiveGroup = $groupHueLightsService->getAllNonActiveGroups();
        if($resultActive['status']){
            $result['active'] = $resultActive['result'];
        }
        if($resultNonactive['status']){
            $result['nonactive'] = $resultNonactive['result'];
        }
        if($resultActiveGroup['status']){
            $result['activeGroup'] = $resultActiveGroup['result'];
        }
        if($resultNonactiveGroup['status']){
            $result['nonactiveGroup'] = $resultNonactiveGroup['result'];
        }
        if(!empty($result)){
            return response()->json($responseService->createSuccessResponse($result));
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_EMPTY_DEVICE_LIST, ResponseService::EMPTY_DEVICE_LIST_MESSAGE));
    }

    /**
     * @param GroupHueLightsService $groupHueLightsService
     * @param DeviceService $deviceService
     * @param Request $request
     * @param ResponseService $responseService
     * @return JsonResponse
     */
    public function setStatus(GroupHueLightsService $groupHueLightsService, DeviceService $deviceService, Request $request, ResponseService $responseService){
        $data = json_decode($request->getContent());
        if(isset($data->id_device) && isset($data->active) && isset($data->type)){
            if($data->type === 'nodeMCU' || $data->type === 'Hue white lamp' || $data->type === 'Hue white spot'){
                $device = new Device();
                $device->setIDDevice($data->id_device);
                $device->setActive($data->active);
                $result = $deviceService->setActiveStatus($device);
                if(!empty($result['status'])){
                    return response()->json(['status' => true]);
                }
                return response()->json(['status' => false]);
            }else{
                $group = new GroupHueLights();
                $group->setActive($data->active);
                $group->setIdGroup($data->id_device);
                $result = $groupHueLightsService->setActiveStatus($group);
                if(!empty($result['status'])){
                    return response()->json($responseService->createSuccessResponse(['result' => 'Success!']));
                }
                return response()->json($responseService->createErrorResponse(ResponseService::CODE_DEVICE_SET_STATUS_FAIL, ResponseService::DEVICE_SET_STATUS_FAIL_MESSAGE));
            }
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_DATA_IS_INCORRECT, ResponseService::DATA_IS_INCORRECT_MESSAGE));
    }
}
