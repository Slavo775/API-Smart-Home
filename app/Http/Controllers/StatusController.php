<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:28
 */

namespace App\Http\Controllers;


use App\Services\StatusService;

class StatusController extends Controller
{

    public function getAllUnresolvedStatus(StatusService $statusService){
       $status = $statusService->getAllStatus();
       if(!empty($status)){
           return response()->json(['status' => true, 'data' => $status]);
       }
       return response()->json(['status' => false, 'data' => null]);
    }

}
