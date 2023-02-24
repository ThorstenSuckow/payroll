<?php

declare(strict_types=1);

namespace Tests\Payroll;

use Exception;
use Payroll\Employee;
use Payroll\EmployeeException;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function testMake()
    {
        $employeeData = [
            [1234, "Peter Parker", "New York", "H", 1245.5],
            [1234, "Peter Parker", "New York", "S", 1245.5],
            [1234, "Peter Parker", "New York", "C", 1245.5, 400]
        ];

        foreach ($employeeData as $data) {
            $employee = Employee::make(...$data);
            $this->assertEmployeeData($employee, ...$data);
        }
    }

    public function testWorksByHour()
    {
        $employeeData = [
            "H" => [1234, "Peter Parker", "New York", "H", 1245.5],
            "S" => [1234, "Peter Parker", "New York", "S", 1245.5]
        ];

        $employee = Employee::make(...$employeeData["H"]);
        $this->assertTrue($employee->worksByHour());

        $employee = Employee::make(...$employeeData["S"]);
        $this->assertFalse($employee->worksByHour());
    }

    public function testMakeException()
    {
        $employeeData = [
            [[1234, "Peter Parker", "New York", "M", 1245.5], "invalid salary type"],
            [[1234, "Peter Parker", "New York", "C", 1245.5], "invalid commission rate"]
        ];

        foreach ($employeeData as $testData) {
            [$data, $errorMessage] = $testData;

            try {
                Employee::make(...$data);
                $this->fail();
            } catch (Exception $e) {
                $this->assertInstanceOf(EmployeeException::class, $e);
                $this->assertStringContainsString($errorMessage, $e->getMessage());
            }
        }
    }



    private function assertEmployeeData(
        Employee $employee,
        int $empId,
        string $name,
        string $address,
        string $salaryType,
        float $amount,
        float $commissionRate = null
    ) {

        $this->assertSame($empId, $employee->getEmpId());
        $this->assertSame($name, $employee->getName());
        $this->assertSame($address, $employee->getAddress());
        $this->assertSame($salaryType, $employee->getSalaryType());
        $this->assertSame($amount, $employee->getAmount());
        $this->assertSame($commissionRate, $employee->getCommissionRate());
    }
}
