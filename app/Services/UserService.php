<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:35
 */

namespace App\Services;

use App\User_model;
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
     * @param User_model $user
     * @return bool
     */
    public function addUser(User_model $user): bool
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
     * @param User_model $user
     * @return array
     */
    public function getUserById(User_model $user){
        $sql = DB::raw('SELECT * FROM user WHERE id_user = :id_user LIMIT 1');
        $result = DB::select($sql, ['id_user' => $user->getIdUser()]);
        return $result;
    }

}
