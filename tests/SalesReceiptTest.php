<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use PHPUnit\Framework\TestCase;
use Payroll\SalesReceipt;

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
}
