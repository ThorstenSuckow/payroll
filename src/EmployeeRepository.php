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
        return new Employee($empId, $name, $address, $salaryType, $amount, $commision);
    }
}
