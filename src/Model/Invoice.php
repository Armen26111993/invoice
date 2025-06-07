<?php
namespace App\Model;

use DateTime;

class Invoice {

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $number;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var DateTime
     */
    private DateTime $date;

    /**
     * @var float
     */
    private float $discount;

    /**
     * @var array
     */
    private array $items = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $status
     * @return Invoice
     */
    public function setStatus(string $status): Invoice
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param DateTime $date
     * @return Invoice
     */
    public function setDate(DateTime $date): Invoice
    {
        $this->date = $date;
        return $this;
    }
    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param float|int $discount
     * @return Invoice
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }
    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param InvoiceItem $item
     */
    public function addItem(InvoiceItem $item): void {
        $this->items[] = $item;
    }
}
