<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-08-15
 * Time: 21:15
 */

namespace App;


use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @var int */
    private $id_status;
    /** @var int */
    private $status_type;
    /** @var \DateTime */
    private $status_time;
    /** @var bool */
    private $resolved;
    /** @var int */
    private $status_code;
    /** @var string */
    private $resolved_text;

    /**
     * @return string
     */
    public function getResolvedText(): string
    {
        return $this->resolved_text;
    }

    /**
     * @param string $resolved_text
     * @return Status
     */
    public function setResolvedText(string $resolved_text): Status
    {
        $this->resolved_text = $resolved_text;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getResolvedDate(): \DateTime
    {
        return $this->resolved_date;
    }

    /**
     * @param \DateTime $resolved_date
     * @return Status
     */
    public function setResolvedDate(\DateTime $resolved_date): Status
    {
        $this->resolved_date = $resolved_date;
        return $this;
    }
    /** @var \DateTime */
    private $resolved_date;

    /**
     * @return int
     */
    public function getIdStatus(): int
    {
        return $this->id_status;
    }

    /**
     * @param int $id_status
     * @return Status
     */
    public function setIdStatus(int $id_status): Status
    {
        $this->id_status = $id_status;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusType(): int
    {
        return $this->status_type;
    }

    /**
     * @param int $status_type
     * @return Status
     */
    public function setStatusType(int $status_type): Status
    {
        $this->status_type = $status_type;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStatusTime(): \DateTime
    {
        return $this->status_time;
    }

    /**
     * @param \DateTime $status_time
     * @return Status
     */
    public function setStatusTime(\DateTime $status_time): Status
    {
        $this->status_time = $status_time;
        return $this;
    }

    /**
     * @return bool
     */
    public function isResolved(): bool
    {
        return $this->resolved;
    }

    /**
     * @param bool $resolved
     * @return Status
     */
    public function setResolved(bool $resolved): Status
    {
        $this->resolved = $resolved;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * @param int $status_code
     * @return Status
     */
    public function setStatusCode(int $status_code): Status
    {
        $this->status_code = $status_code;
        return $this;
    }

}
