<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:36
 */

namespace App\Services;

use App\Exercise;
use App\Status;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\DB;

class ExerciseService
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
     * @return array
     */
    public function getAllExercise()
    {
        $sql = DB::raw('SELECT * FROM exercise');
        $result = DB::select($sql);
        return $result;
    }

    /**
     * @param Exercise $exercise
     * @return bool
     */
    public function addExercise(Exercise $exercise)
    {
        $sql = DB::raw('INSERT INTO exercise (name, unit, kcal_per_unit) VALUES (:name, :unit, :kcal_per_unit)');
        $result = DB::insert($sql, [
            'name' => $exercise->getName(),
            'unit' => $exercise->getUnit(),
            'kcal_per_unit' => $exercise->getKcalPerUnit()
        ]);
        return $result;
    }

    /**
     * @param Exercise $exercise
     * @return array
     */
    public function getExerciseById(Exercise $exercise){
        $sql = DB::raw('SELECT * FROM exercise WHERE id_exercise = :id_exercise');
        $result = DB::select($sql, ['id_exercise' => $exercise->getIdExercise()]);
        return $result;
    }

}
