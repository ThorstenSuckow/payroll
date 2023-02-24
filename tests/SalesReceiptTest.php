<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use Payroll\SalesReceipt;
use PHPUnit\Framework\TestCase;

class SalesReceiptTest extends TestCase
{
    public function testSalesReceiptTest()
    {
        $date = new DateTime();
        $amount = (float)500;

        $formatStr = "Y-m-d H:m:i";
        $receipt = SalesReceipt::make($date, $amount);

        $this->assertNotSame($date, $receipt->getDate());
        $this->assertSame($date->format($formatStr), $receipt->getDate()->format($formatStr));
        $this->assertSame($amount, $receipt->getAmount());
    }


    public function testEqualTo()
    {
        $date = new DateTime();
        $amount = 500;

        $lft = SalesReceipt::make($date, $amount);
        $rgt = SalesReceipt::make($date, $amount + 1);
        $center = SalesReceipt::make(new DateTime("1.1.1970"), $amount);

        $this->assertTrue($lft->equalTo($lft));
        $this->assertFalse($lft->equalTo($rgt));
        $this->assertFalse($center->equalTo($lft));
    }
}
