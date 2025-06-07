<?php

namespace App\Model;

class InvoiceItem {

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param float $amount
     * @return InvoiceItem
     */
    public function setAmount(float $amount): InvoiceItem
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param int $quantity
     * @return InvoiceItem
     */
    public function setQuantity(int $quantity): InvoiceItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
