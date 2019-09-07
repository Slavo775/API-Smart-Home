<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-09-07
 * Time: 18:20
 */

namespace App\Services;


use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Mixed_;

class ResponseService
{
    /** @var int  */
    public const CODE_SUCCESS = 200;
    /** @var int  */
    public const CODE_ALL_RESOLVED = 201;

    /** @var int  */
    public const CODE_UNDEFINED_ERROR = 500;

    /** INPUT ERRORS  */
    /** @var int  */
    public const CODE_DATA_IS_EMPTY = 601;
    /** @var int  */
    public const CODE_EMPTY_INPUT = 602;
    /** @var int  */
    public const CODE_INVALID_IP = 603;
    /** @var int  */
    public const CODE_DATA_IS_INCORRECT = 604;


    /** DATABASE ERRORS */
    /** @var int  */
    public const CODE_DATABASE_ERROR = 700;
    /** @var int  */
    public const CODE_CANNOT_INSERT_TO_DATABASE = 701;
    /** @var int  */
    public const CODE_DEVICE_EXIST_IN_DATABASE = 702;

    /** DEVICES ERRORS */
    public const CODE_DEVICE_ERROR = 800;
    /** @var int  */
    public const CODE_DEVICE_NOT_REACHABLE = 801;
    /** @var int  */
    public const CODE_EMPTY_DEVICE_LIST = 802;
    /** @var int  */
    public const CODE_DEVICE_SET_STATUS_FAIL = 803;

    /** @var string  */
    public const SUCCESS_MESSAGE = 'Ok!';
    /** @var string  */
    public const DATE_EMPTY_MESSAGE = 'Data is empty!';
    /** @var string  */
    public const UNDEFINED_ERROR_MESSAGE = 'Oooops something went wrong!';
    /** @var string  */
    public const EMPTY_INPUT_MESSAGE = 'Please fill all field!';
    /** @var string  */
    public const DEVICE_NOT_REACHABLE = 'The device is not responding!';
    /** @var string  */
    public const DEVICE_EXIST_IN_DATABASE_MESSAGE = 'Device is exist in database with ip ';
    /** @var string  */
    public const CANNOT_INSERT_MESSAGE = 'Insert to database failed!';
    /** @var string  */
    public const DATA_IS_EMPTY_MESSAGE = 'Data is empty!';
    /** @var string  */
    public const EMPTY_DEVICE_LIST_MESSAGE = 'Device list is empty!';
    /** @var string  */
    public const DEVICE_SET_STATUS_FAIL_MESSAGE = 'Status setting fail!';
    /** @var string  */
    public const DATA_IS_INCORRECT_MESSAGE = 'Data is incorrect!';
    /** @var string  */
    public const ALL_RESOLVED_MESSAGE = 'All resolved!';




    public function __construct()
    {
        /**
         * Setup a new app instance container
         *
         * @var Illuminate\Container\Container
         */
        $app = Container::getInstance();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);
    }

    /**
     * create response array
     * @param array $data
     * @param int $code
     * @param string $message
     * @return array
     */
    public function createSuccessResponse(array $data, int $code = self::CODE_SUCCESS, string $message = self::SUCCESS_MESSAGE){
        return !empty($data) ?  ['status' => true, 'code' => $code, 'message' => $message, 'data' => $data] : ['status' => false, 'code' => self::CODE_DATA_IS_EMPTY, 'message' => self::DATE_EMPTY_MESSAGE, 'data' => null];
    }

    public function createErrorResponse(int $errorCode = self::CODE_UNDEFINED_ERROR, string $message = self::UNDEFINED_ERROR_MESSAGE){
        return ['status' => false, 'code' => $errorCode, 'message' => $message, 'data' => null];
    }

}
