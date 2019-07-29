<?php

namespace PhpTwinfield;

/**
 * Class PaymentMethod
 */
class PaymentMethod
{
    /**
     * @var string The code of the Payment Method.
     */
    private $code;

    /**
     * @var string The name of the Payment Method.
     */
    private $name;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
