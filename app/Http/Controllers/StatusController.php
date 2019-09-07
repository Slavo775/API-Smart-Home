<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:28
 */

namespace App\Http\Controllers;


use App\Services\ResponseService;
use App\Services\StatusService;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * get all status with value 0 of column resolved
     * @param StatusService $statusService
     * @param ResponseService $responseService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUnresolvedStatus(StatusService $statusService, ResponseService $responseService){
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
           return response()->json($responseService->createSuccessResponse($status));
       }
       return response()->json($responseService->createSuccessResponse(['result' => 'Success!'],ResponseService::CODE_ALL_RESOLVED, ResponseService::ALL_RESOLVED_MESSAGE));
    }

    /**
     * @param StatusService $statusService
     * @param Request $request
     * @param ResponseService $responseService
     * @return \Illuminate\Http\JsonResponse
     */
    public function setResolved(StatusService $statusService, Request $request, ResponseService $responseService){
        $data = json_decode($request->getContent());
        $statusModel = new Status();
        if(isset($data->id_status) && isset($data->status_text)){
            $statusModel->setIdStatus($data->id_status);
            $statusModel->setResolvedText($data->status_text);
            $status = $statusService->setResolvedStatus($statusModel);
            if($status){
                return response()->json($responseService->createSuccessResponse(['result' => 'Success!']));
            }
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_CANNOT_INSERT_TO_DATABASE, ResponseService::CANNOT_INSERT_MESSAGE));
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_DATA_IS_INCORRECT, ResponseService::DATA_IS_INCORRECT_MESSAGE));
    }

}
