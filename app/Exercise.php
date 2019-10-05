<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:23
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    /** @var integer */
    private $id_exercise;
    /** @var string */
    private $name;
    /** @var string */
    private $unit;
    /** @var int */
    private $kcal_per_unit;

    /**
     * @return int
     */
    public function getIdExercise(): int
    {
        return $this->id_exercise;
    }

    /**
     * @param int $id_exercise
     * @return Exercise
     */
    public function setIdExercise(int $id_exercise): Exercise
    {
        $this->id_exercise = $id_exercise;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Exercise
     */
    public function setName(string $name): Exercise
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Exercise
     */
    public function setUnit(string $unit): Exercise
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return int
     */
    public function getKcalPerUnit(): int
    {
        return $this->kcal_per_unit;
    }

    /**
     * @param int $kcal_per_unit
     * @return Exercise
     */
    public function setKcalPerUnit(int $kcal_per_unit): Exercise
    {
        $this->kcal_per_unit = $kcal_per_unit;
        return $this;
    }

}
