<?php

declare(strict_types=1);

namespace Payroll;

use DateTime;

class SalesReceipt
{
    use GetterTrait;

    private DateTime $date;
    private float $amount;


    public static function make(DateTime $date, float $amount): self
    {
        return new self($date, $amount);
    }


    private function __construct(DateTime $date, float $amount)
    {
        $this->date = clone $date;
        $this->amount = $amount;
    }


    private function getMembers(): array
    {
        return ["date", "amount"];
    }
}
