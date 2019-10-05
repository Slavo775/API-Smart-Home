<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:26
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ExerciseStatus extends Model
{
    /** @var integer */
    private $id_exercise_status;
    /** @var integer */
    private $count;
    /** @var \DateTime */
    private $date;
    /** @var integer */
    private $id_user;
    /** @var integer */
    private $id_exercise;

    /**
     * @return int
     */
    public function getIdExerciseStatus(): int
    {
        return $this->id_exercise_status;
    }

    /**
     * @param int $id_exercise_status
     * @return ExerciseStatus
     */
    public function setIdExerciseStatus(int $id_exercise_status): ExerciseStatus
    {
        $this->id_exercise_status = $id_exercise_status;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return ExerciseStatus
     */
    public function setCount(int $count): ExerciseStatus
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return ExerciseStatus
     */
    public function setDate(\DateTime $date): ExerciseStatus
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return ExerciseStatus
     */
    public function setIdUser(int $id_user): ExerciseStatus
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdExercise(): int
    {
        return $this->id_exercise;
    }

    /**
     * @param int $id_exercise
     * @return ExerciseStatus
     */
    public function setIdExercise(int $id_exercise): ExerciseStatus
    {
        $this->id_exercise = $id_exercise;
        return $this;
    }


}
