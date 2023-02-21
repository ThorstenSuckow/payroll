<?php

declare(strict_types=1);

namespace Payroll;

use BadMethodCallException;
use DateTime;

class TimeCard
{
    private readonly DateTime $date;
    private readonly int $hours;

    public static function make(DateTime $date, int $hours): self
    {
        return new self($date, $hours);
    }

    private function __construct(DateTime $date, int $hours)
    {
        $this->date = $date;
        $this->hours = $hours;
    }


    public function __call($method, $args): mixed
    {
        $prop = lcfirst(substr($method, 3));

        $members = ["date", "hours"];

        if (in_array($prop, $members)) {
            return $this->$prop;
        }

        throw new BadMethodCallException("$method not found.");
    }
}
