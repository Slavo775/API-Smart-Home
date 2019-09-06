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
        if(!empty($result['status'])){
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Ok!', 'result' => $result['result']]);
        }else{
            return response()->json(['status' => false, 'code' => 404, 'message' => !empty($result['message']) ? $result['message'] : 'Undefined Error!']);
        }

    }

}
