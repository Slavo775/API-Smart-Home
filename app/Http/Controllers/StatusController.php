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

}
