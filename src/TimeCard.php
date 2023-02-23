<?php

declare(strict_types=1);

namespace Payroll;

use BadMethodCallException;
use DateTime;

class TimeCard implements Equatable
{
    use GetterTrait;

    private readonly DateTime $date;
    private readonly int $hours;

    public static function make(DateTime $date, int $hours): self
    {
        return new self($date, $hours);
    }

    public function equalTo(object $cmp): bool
    {
        $myClass = self::class;
        return ($cmp === $this) ||
               (($cmp instanceof $myClass) &&
               ($cmp->getDate()->format("Y-m-d H:i:s") === $this->getDate()->format("Y-m-d H:i:s")) &&
               $cmp->getHours() === $this->getHours());
    }


    private function __construct(DateTime $date, int $hours)
    {
        $this->date = clone $date;
        $this->hours = $hours;
    }

    private function getMembers(): array
    {
        return ["date", "hours"];
    }
}
