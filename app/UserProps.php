<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 15:12
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserProps extends Model
{
    /** @var integer */
    private $id_user_props;
    /** @var integer */
    private $height;
    /** @var integer */
    private $weight;
    /** @var integer */
    private $waistline;
    /** @var integer */
    private $circumreference_of_hand;
    /** @var integer */
    private $circumreference_of_leg;
    /** @var /DateTime */
    private $date;
    /** @var integer */
    private $id_user;

    /**
     * @return int
     */
    public function getIdUserProps(): int
    {
        return $this->id_user_props;
    }

    /**
     * @param int $id_user_props
     */
    public function setIdUserProps(int $id_user_props): void
    {
        $this->id_user_props = $id_user_props;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getWaistline(): int
    {
        return $this->waistline;
    }

    /**
     * @param int $waistline
     */
    public function setWaistline(int $waistline): void
    {
        $this->waistline = $waistline;
    }

    /**
     * @return int
     */
    public function getCircumreferenceOfHand(): int
    {
        return $this->circumreference_of_hand;
    }

    /**
     * @param int $circumreference_of_hand
     */
    public function setCircumreferenceOfHand(int $circumreference_of_hand): void
    {
        $this->circumreference_of_hand = $circumreference_of_hand;
    }

    /**
     * @return int
     */
    public function getCircumreferenceOfLeg(): int
    {
        return $this->circumreference_of_leg;
    }

    /**
     * @param int $circumreference_of_leg
     */
    public function setCircumreferenceOfLeg(int $circumreference_of_leg): void
    {
        $this->circumreference_of_leg = $circumreference_of_leg;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

}
