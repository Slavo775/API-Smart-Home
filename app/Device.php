<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-20
 * Time: 21:10
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /** @var int */
    private $ID_device;
    /** @var string */
    private $Type_of_device;
    /** @var string */
    private $role;
    /** @var string */
    private $location;
    /** @var string */
    private $IP_adress;
    /** @var string */
    private $name;
    /** @var string */
    private $Description;
    /** @var string */
    private $Status;
    /** @var string */
    private $mac;


    /**
     * @return string
     */
    public function getMac() :?string
    {
        return $this->mac;
    }

    /**
     * @param int $mac
     * @return Device
     */
    public function setMac(string $mac) :Device
    {
        $this->mac = $mac;
        return $this;
    }
    /**
     * @return int
     */
    public function getIDDevice() :?int
    {
        return $this->ID_device;
    }

    /**
     * @param int $ID_device
     * @return Device
     */
    public function setIDDevice(int $ID_device) :Device
    {
        $this->ID_device = $ID_device;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeOfDevice() :?string
    {
        return $this->Type_of_device;
    }

    /**
     * @param string $Type_of_device
     * @return Device
     */
    public function setTypeOfDevice(string $Type_of_device) :Device
    {
        $this->Type_of_device = $Type_of_device;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole():?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Device
     */
    public function setRole(string $role) :Device
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation() :?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Device
     */
    public function setLocation(string $location) :Device
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getIPAdress() :?string
    {
        return $this->IP_adress;
    }

    /**
     * @param string $IP_adress
     * @return Device
     */
    public function setIPAdress(string $IP_adress) :Device
    {
        $this->IP_adress = $IP_adress;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() :?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Device
     */
    public function setName(string $name):Device
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() :?string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     * @return Device
     */
    public function setDescription(string $Description) :Device
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus() :?string
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     * @return Device
     */
    public function setStatus(string $Status) :Device
    {
        $this->Status = $Status;
        return $this;
    }

}
