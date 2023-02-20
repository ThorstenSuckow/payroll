<?php

declare(strict_types=1);

namespace Payroll;

class EmployeeRepository
{
    private array $data = [];


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


    public function deleteEmployee(int $empId): bool
    {
        if (!$this->employeeExists(empId: $empId)) {
            throw new EmployeeRepositoryException("Employee not found (empdId=$empId).");
        }

        unset($this->data[$empId]);

        return true;
    }

    public function employeeExists(int $empId)
    {
        return array_key_exists($empId, $this->data);
    }


    public function employeeCount()
    {
        return count(array_values($this->data));
    }


    private function add(Employee $employee): Employee
    {
        $empId = $employee->getEmpId();

        if ($this->employeeExists($empId)) {
            throw new EmployeeRepositoryException("Employee already exists (empId=$empId).");
        }

        $this->data[$empId] = $employee;

        return $employee;
    }
}
