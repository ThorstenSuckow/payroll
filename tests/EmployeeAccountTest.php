<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use Payroll\Charge;
use Payroll\EmployeeAccount;
use PHPUnit\Framework\TestCase;

class EmployeeAccountTest extends TestCase
{
    public function testBelongsTo()
    {
        $account = new EmployeeAccount(1234);
        $this->assertSame($account->belongsTo(), 1234);
    }


    public function testAddCharge()
    {
        $account = new EmployeeAccount(1234);

        $date = new DateTime();
        $amount = (float)500;
        $chargeType = "ServiceCharge";

        $newCharge = $account->addCharge($amount, $chargeType);

        $this->assertTrue(
            $newCharge->equalTo(
                Charge::make($date, $amount, $chargeType)
            )
        );
    }
}
