<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use PHPUnit\Framework\TestCase;
use Payroll\TimeCard;
use stdClass;

class TimeCardTest extends TestCase
{
    public function testTimeCard()
    {
        $date = new DateTime();
        $hours = 100;
        $timeCard = TimeCard::make($date, $hours);

        $this->assertInstanceOf(TimeCard::class, $timeCard);

        $this->assertNotSame($date, $timeCard->getDate());
        $this->assertSame($date->format("Y-m-d H:i:s"), $timeCard->getDate()->format("Y-m-d H:i:s"));
        $this->assertSame($hours, $timeCard->getHours());
    }

    public function testEqualTo()
    {
        $date = new DateTime();
        $hours = 100;

        $timeCard = TimeCard::make($date, $hours);
        
        $this->assertTrue($timeCard->equalTo($timeCard));
        $this->assertTrue($timeCard->equalTo(TimeCard::make($date, $hours)));
        $this->assertFalse($timeCard->equalTo(TimeCard::make($date, $hours + 1)));
        $this->assertFalse($timeCard->equalTo(new stdClass));
    }

}
