<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use PHPUnit\Framework\TestCase;
use Payroll\TimeCard;

class TimeCardTest extends TestCase
{
    public function testTimeCard()
    {
        $timeCard = TimeCard::make(new DateTime(), 100);

        $this->assertInstanceOf(TimeCard::class, $timeCard);
    }
}
