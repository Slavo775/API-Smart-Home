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

    public function getAllActive(GroupHueLightsService $groupHueLightsService){
        return response()->json(['result' => $groupHueLightsService->getGroupsWithDevices()['result']]);
    }

}
