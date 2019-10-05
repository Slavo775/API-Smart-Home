<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 16:16
 */

namespace App\Http\Controllers;


use App\Services\ResponseService;
use App\Services\UserService;
use App\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function registerUser(UserService $userService, ResponseService $responseService, Request $request)
    {
        $data = json_decode($request->getContent());
        $user = new UserModel();
        if (!empty($data->name)) {
            $user->setName($data->name);
            try {
                $userService->addUser($user);
                return response()->json($responseService->createSuccessResponse());
            } catch (\Exception $ex) {
                return response()->json($responseService->createErrorResponse(ResponseService::CODE_CANNOT_INSERT_TO_DATABASE, $ex->getMessage()));
            }
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_DATA_IS_INCORRECT,
            ResponseService::DATA_IS_INCORRECT_MESSAGE));
    }

    public function getAllUser(UserService $userService, ResponseService $responseService)
    {
        try{
        return response()->json($responseService->createSuccessResponse($userService->getAllUser()));
        } catch (\Exception $ex){
            return response()->json($responseService->createErrorResponse(ResponseService::CODE_CANNOT_SELECT_FROM_DATABASE, $ex->getMessage()));
        }
    }

    public function getUserById(UserService $userService, ResponseService $responseService, Request $request)
    {
        $data = json_decode($request->getContent());
        $user = new UserModel();
        if (!empty($data->id_user)) {
            $user->setIdUser($data->id_user);
            try{
            $userById = $userService->getUserById($user);
            return response()->json($responseService->createSuccessResponse($userById));
            } catch (\Exception $ex){
                return response()->json($responseService->createErrorResponse(ResponseService::CODE_CANNOT_SELECT_FROM_DATABASE, $ex->getMessage()));
            }
        }
        return response()->json($responseService->createErrorResponse(ResponseService::CODE_DATA_IS_INCORRECT,
            ResponseService::DATA_IS_INCORRECT_MESSAGE));
    }
}
