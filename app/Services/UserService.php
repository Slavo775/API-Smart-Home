<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:35
 */

namespace App\Services;

use App\User_model;
use App\UserModel;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct()
    {
        /**
         * Setup a new app instance container
         *
         * @var Container
         */
        $app = Container::getInstance();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);
    }

    /**
     * Add user into database
     * @param UserModel $user
     * @return bool
     */
    public function addUser(UserModel $user): bool
    {
        $sql = DB::raw('INSERT INTO user (name) VALUES (:name)');
        $result = DB::insert($sql, ['name' => $user->getName()]);
        return $result;
    }

    /**
     * Get all user from database
     * @return array
     */
    public function getAllUser(){
        $sql = DB::raw('SELECT * FROM user');
        $result = DB::select($sql);
        return $result;
    }

    /**
     * Get one user by user id
     * @param UserModel $user
     * @return array
     */
    public function getUserById(UserModel $user){
        $sql = DB::raw('SELECT * FROM user WHERE id_user = :id_user LIMIT 1');
        $result = DB::select($sql, ['id_user' => $user->getIdUser()]);
        return $result;
    }

}
