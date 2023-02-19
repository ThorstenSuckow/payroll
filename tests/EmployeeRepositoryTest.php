<?php

declare(strict_types=1);

namespace Tests\Payroll;

use PHPUnit\Framework\TestCase;
use Payroll\EmployeeRepository;
use Payroll\Employee;
use Payroll\EmployeeRepositoryException;

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
            $this->assertInstanceOf(Employee::class, $employee);
        }
    }

    public function testAddNewEmployeeException()
    {

        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessage("not a valid Employee");
        $employeeData = [1234, "Peter Parker", "New York", "K", 9090];

        $repository = new EmployeeRepository();

        $repository->addEmployee(...$employeeData);
    }
}
