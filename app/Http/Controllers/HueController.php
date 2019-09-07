<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-30
 * Time: 21:20
 */

namespace App\Http\Controllers;


use App\Services\GroupHueLightsService;
use App\Services\ResponseService;

class HueController extends Controller
{
    /**
     * @param GroupHueLightsService $groupHueLightsService
     * @param ResponseService $responseService
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\invalidArrayKeyException
     */
    public function getAllActive(GroupHueLightsService $groupHueLightsService, ResponseService $responseService){
        $result = $groupHueLightsService->getGroupsWithDevices();
        if(!empty($result['status'])){
            return response()->json($responseService->createSuccessResponse($result['result']));
        }else{
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_DEVICE_ERROR, !empty($result['message']) ? $result['message'] : 'Undefined Error!'));
        }

    }

}
