<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:28
 */

namespace App\Http\Controllers;


use App\Services\StatusService;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * get all status with value 0 of column resolved
     * @param StatusService $statusService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUnresolvedStatus(StatusService $statusService){
       $status = [];
       $errors = $statusService->getErrorStatus();
       $warnings = $statusService->getWarningStatus();
       $info = $statusService->getInfoStatus();
       if($errors['status']){
           $status['errors'] = $errors['result'];
       }

       if($warnings['status']){
         $status['warnings'] = $warnings['result'];
       }

       if($info['status']){
           $status['infos'] = $info['result'];
       }

       if(!empty($status)){
           return response()->json(['status' => true, 'data' => $status]);
       }
       return response()->json(['status' => false, 'data' => null]);
    }

    public function setResolved(StatusService $statusService, Request $request){
        $data = json_decode($request->getContent());
        $statusModel = new Status();
        if(isset($data->id_status)){
            $statusModel->setIdStatus($data->id_status);
            $status = $statusService->setResolvedStatus($statusModel);
            if($status){
                return response()->json(['status' => true]);
            }
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => false]);
    }

}
