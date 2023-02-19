<?php

declare(strict_types=1);

namespace Payroll;

class EmployeeRepository
{
    public function addEmployee(
        int $empId,
        string $name,
        string $address,
        string $salaryType,
        float $amount,
        ?float $commision = null
    ): Employee {


        try {
            $employee = Employee::make($empId, $name, $address, $salaryType, $amount, $commision);
        } catch (EmployeeException $e) {
            throw new EmployeeRepositoryException("not a valid Employee", 0, $e);
        }

        return $this->add($employee);
    }


    private function add(Employee $employee): Employee
    {
        return $employee;
    }
}
