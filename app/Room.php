<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-29
 * Time: 21:46
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @var string */
    private $name;
    /** @var string */
    private $description;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Room
     */
    public function setName(string $name): Room
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Room
     */
    public function setDescription(string $description): Room
    {
        $this->description = $description;
        return $this;
    }


}
