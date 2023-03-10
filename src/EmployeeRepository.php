<?php

declare(strict_types=1);

namespace Payroll;

use DateTime;

class EmployeeRepository
{
    private array $data = [];
    private array $timeCards = [];
    private array $salesReceipts = [];

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


    public function postTimeCard(int $empId, DateTime $date, int $hours): ?TimeCard
    {
        if (!$this->employeeExists($empId)) {
            throw new EmployeeRepositoryException("Employee not found (empId=$empId)");
        }

        if ($this->employeeExists($empId) && !$this->employee($empId)->worksByHour()) {
            throw new EmployeeRepositoryException("Employee does not work by the hour (empId=$empId)");
        }

        if (!array_key_exists($empId, $this->timeCards)) {
            $this->timeCards[$empId] = [];
        }

        $timeCard = TimeCard::make($date, $hours);
        $this->timeCards[$empId][] = TimeCard::make($date, $hours);

        return $timeCard;
    }


    public function postSalesReceipt(int $empId, DateTime $date, float $amount): ?SalesReceipt
    {
        if (!$this->employeeExists($empId)) {
            throw new EmployeeRepositoryException("Employee not found (empId=$empId)");
        }

        if ($this->employee($empId)->getSalaryType() !== "C") {
            throw new EmployeeRepositoryException("Employee is not commissioned (empId=$empId)");
        }


        $salesReceipt = SalesReceipt::make($date, $amount);
        $this->salesReceipts[$empId][] = SalesReceipt::make($date, $amount);

        return $salesReceipt;
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


    public function employee(int $empId): ?Employee
    {
        if (!$this->employeeExists($empId)) {
            return null;
        }

        return $this->data[$empId];
    }
}
