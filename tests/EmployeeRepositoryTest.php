<?php

declare(strict_types=1);

namespace Tests\Payroll;

use PHPUnit\Framework\TestCase;
use Payroll\EmployeeRepository;
use Payroll\Employee;

class EmployeeRepositoryTest extends TestCase
{
    /**
     * Use Case 1: Add New Employee
     */
    public function testAddNewEmployee()
    {
        $repository = new EmployeeRepository();

        $employeeData = [
            [1234, "Peter Parker", "New York", "H", 1245.5],
            [1234, "Peter Parker", "New York", "S", 1245.5], 
            [1234, "Peter Parker", "New York", "C", 1245.5, 400]
        ];

        foreach ($employeeData as $data) {
            $employee = $repository->addEmployee(...$data);
            $this->assertEmployeeData($employee, ...$data);    
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
