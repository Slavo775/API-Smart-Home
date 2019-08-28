<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-28
 * Time: 20:57
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class GroupHueLights extends Model
{
    /** @var integer */
    private $id_group;
    /** @var string */
    private $type;
    /** @var string */
    private $class;
    /** @var boolean */
    private $active;
    /** @var string */
    private $name;

    /**
     * @return int
     */
    public function getIdGroup(): int
    {
        return $this->id_group;
    }

    /**
     * @param int $id_group
     * @return GroupHueLights
     */
    public function setIdGroup(int $id_group): GroupHueLights
    {
        $this->id_group = $id_group;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return GroupHueLights
     */
    public function setType(string $type): GroupHueLights
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return GroupHueLights
     */
    public function setClass(string $class): GroupHueLights
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return GroupHueLights
     */
    public function setActive(bool $active): GroupHueLights
    {
        $this->active = $active;
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
     * @return GroupHueLights
     */
    public function setName(string $name): GroupHueLights
    {
        $this->name = $name;
        return $this;
    }


}
