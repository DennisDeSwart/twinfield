<?php

namespace PhpTwinfield;

/**
 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Masters/Projects
 */
class ProjectQuantity
{
    private $label;
    private $rate;
    private $billable;
    private $mandatory;

    public function getBillable()
    {
        return $this->billable;
    }

    public function setBillable($billable)
    {
        $this->billable = $billable;
        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getMandatory()
    {
        return $this->mandatory;
    }

    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
        return $this;
    }
}
