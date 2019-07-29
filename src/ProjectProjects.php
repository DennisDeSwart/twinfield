<?php

namespace PhpTwinfield;

/**
 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Masters/Projects
 */
class ProjectProjects
{
    private $validfrom;
    private $validtill;
    private $invoicedescription;
    private $authoriser;
    private $customer;
    private $billable;
    private $rate;
    private $quantities = array();

    public function getValidFrom()
    {
        return $this->validfrom;
    }

    public function setValidFrom($validFrom)
    {
        $this->validfrom = $validFrom;
        return $this;
    }

    public function getValidTill()
    {
        return $this->validtill;
    }

    public function setValidTill($validTill)
    {
        $this->validtill = $validTill;
        return $this;
    }

    public function getInvoiceDescription()
    {
        return $this->invoicedescription;
    }

    public function setInvoiceDescription($invoiceDescription)
    {
        $this->invoicedescription = $invoiceDescription;
        return $this;
    }

    public function getAuthoriser()
    {
        return $this->authoriser;
    }

    public function setAuthoriser($authoriser)
    {
        $this->authoriser = $authoriser;
        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

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

    public function getQuantities()
    {
        return $this->quantities;
    }

    public function addQuantity(ProjectQuantity $quantity)
    {
        $this->quantities[] = $quantity;
        return $this;
    }
}
