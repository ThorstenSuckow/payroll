<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2023 Thorsten Suckow-Homberg https://github.com/ThorstenSuckow/payroll
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace Tests\Payroll\Domain\Company;

use Payroll\Domain\Company\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function testMake(): void
    {
        $checks = ["H", "C", "S"];

        foreach ($checks as $check) {
            $data = $this->getTestData($check);

            /* @phpstan-ignore-next-line */
            $employee = Employee::make(...$data);

            $this->assertSame($data["empId"], $employee->getEmpId());
            $this->assertSame($data["name"], $employee->getName());
            $this->assertSame($data["address"], $employee->getAddress());
            $this->assertSame($data["salaryType"], $employee->getSalaryType());
            $this->assertSame($data["rate"], $employee->getRate());

            if ($data["salaryType"] === "C") {
                $this->assertNotNull($employee->getCommissionRate());
                $this->assertSame($data["commissionRate"], $employee->getCommissionRate());
            } else {
                $this->assertNull($employee->getCommissionRate());
            }
        }

        $this->assertInstanceOf(Employee::class, $employee);
    }

    /**
     * @return array<string, mixed>
     */
    protected function getTestData(string $dataType): array
    {
        return [
            "H" => ["empId" => "empId", "name" => "name", "address" => "address", "salaryType" => "H", "rate" => 0.0],
            "S" => ["empId" => "empId", "name" => "name", "address" => "address", "salaryType" => "S", "rate" => 0.0],
            "C" => [
                "empId" => "empId", "name" => "name", "address" => "address", "salaryType" => "C", "rate" => 0.0,
                "commissionRate" => 4.0
            ]
        ][$dataType];
    }
}
