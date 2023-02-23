<?php

declare(strict_types=1);

namespace Payroll;

use DateTime;

class SalesReceipt implements Equatable
{
    use GetterTrait;

    private DateTime $date;
    private float $amount;


    public static function make(DateTime $date, float $amount): self
    {
        return new self($date, $amount);
    }

    public function equalTo(object $cmp): bool
    {
        $thisClass = self::class;

        return
            ($cmp === $this) ||
            (
                ($cmp instanceof $thisClass) &&
                ($cmp->getDate()->format("Y-m-d H:i:s") === $this->getDate()->format("Y-m-d H:i:s")) &&
                ($cmp->getAmount() === $this->amount)
            );
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
