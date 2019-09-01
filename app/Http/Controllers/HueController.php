<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-30
 * Time: 21:20
 */

namespace App\Http\Controllers;


use App\Services\GroupHueLightsService;

class HueController extends Controller
{
    /**
     * @param GroupHueLightsService $groupHueLightsService
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\invalidArrayKeyException
     */
    public function getAllActive(GroupHueLightsService $groupHueLightsService){
        $result = $groupHueLightsService->getGroupsWithDevices();
        if(!empty($result['result'])){
            return response()->json(['result' => $result['result']]);
        }else{
            return response()->json(['message' => !empty($result['message']) ? $result['message'] : 'Undefined Error!']);
        }

    }

}
