<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-10-05
 * Time: 14:18
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class User_model extends Model
{
    /** @var integer */
    private $id_user;
    /** @var string */
    private $name;
    /** @var integer */
    private $height;

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return User_model
     */
    public function setIdUser(int $id_user): User_model
    {
        $this->id_user = $id_user;
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
     * @return User_model
     */
    public function setName(string $name): User_model
    {
        $this->name = $name;
        return $this;
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
     * @return User_model
     */
    public function setHeight(int $height): User_model
    {
        $this->height = $height;
        return $this;
    }


}
