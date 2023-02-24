<?php

declare(strict_types=1);

namespace Payroll;

use DateTime;
use Payroll\Equatable;

final class Charge implements Equatable
{
    use GetterTrait;

    private DateTime $date;
    private float $amount;
    private string $chargeType;


    public static function make(DateTime $date, float $amount, string $chargeType): self
    {
        return new self(...func_get_args());
    }

    public function __construct(DateTime $date, float $amount, string $chargeType)
    {
        $this->date = clone $date;
        $this->amount = $amount;
        $this->chargeType = $chargeType;
    }

    public function equalTo(object $cmp): bool
    {
        $thisClass = self::class;

        return
            ($cmp === $this) ||
            (
                ($cmp instanceof $thisClass) &&
                ($cmp->getDate()->format("Y-m-d H:i:s") === $this->getDate()->format("Y-m-d H:i:s")) &&
                ($cmp->getAmount() === $this->amount) &&
                ($cmp->getChargeType() === $this->chargeType)
            );
    }



    private function getMembers(): array
    {
        return ["date", "amount", "chargeType"];
    }
}
