<?php

namespace PhpTwinfield;

use PhpTwinfield\Transactions\TransactionFields\OfficeField;
use PhpTwinfield\Transactions\TransactionLineFields\VatCodeField;

/**
 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Masters/Projects
 */
class Project
{
    use OfficeField;
    use VatCodeField;

    private $code;
    private $UID;
    private $status;
    private $name;
    private $shortname;

    /**
     * Dimension type of projects is PRJ.
     *
     * @var string
     */
    private $type = "PRJ";

    private $inUse;
    private $behaviour;
    private $touched;
    private $vatCode;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getID()
    {
        trigger_error('getID is a deprecated method: Use getCode', E_USER_NOTICE);
        return $this->getCode();
    }

    public function setID($ID)
    {
        trigger_error('setID is a deprecated method: Use setCode', E_USER_NOTICE);
        return $this->setCode($ID);
    }

    public function getUID()
    {
        return $this->UID;
    }

    public function setUID($UID)
    {
        $this->UID = $UID;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getShortName()
    {
        return $this->shortname;
    }

    public function setShortName($shortname)
    {
        $this->shortname = $shortname;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getInUse()
    {
        return $this->inUse;
    }

    public function setInUse($inUse)
    {
        $this->inUse = $inUse;
        return $this;
    }

    public function getBehaviour()
    {
        return $this->behaviour;
    }

    public function setBehaviour($behaviour)
    {
        $this->behaviour = $behaviour;
        return $this;
    }

    public function getTouched()
    {
        return $this->touched;
    }

    public function setTouched($touched)
    {
        $this->touched = $touched;
        return $this;
    }
}
