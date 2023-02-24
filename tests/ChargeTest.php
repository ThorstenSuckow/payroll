<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use PHPUnit\Framework\TestCase;
use Payroll\Charge;
use stdClass;

class ChargeTest extends TestCase
{
    public function testMakeCharge()
    {

        $date = new DateTime();
        $amount = (float) 500;
        $chargeType = "UnionServiceCharge";

        $charge = Charge::make($date, $amount, $chargeType);

        $this->assertNotSame($charge->getDate(), $date);
        $this->assertTrue($charge->equalTo(Charge::make($date, $amount, $chargeType)));
    }


    public function testEqualTo()
    {
        $date = new DateTime();
        $amount = (float)100;
        $chargeType = "UnionServiceCharge";

        $charge = Charge::make($date, $amount, $chargeType);

        $this->assertTrue($charge->equalTo($charge));
        $this->assertTrue($charge->equalTo(Charge::make($date, $amount, $chargeType)));
        $this->assertFalse($charge->equalTo(Charge::make($date, $amount + 1, $chargeType)));
        $this->assertFalse($charge->equalTo(Charge::make($date, $amount, "randomCharge")));
        $this->assertFalse($charge->equalTo(new stdClass()));
    }
}
