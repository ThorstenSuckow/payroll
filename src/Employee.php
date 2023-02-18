<?php

declare(strict_types=1);

namespace Payroll;

class Employee
{
    private readonly int $empId;
    private string $name;
    private string $address;
    private string $salaryType;
    private float $amount;


    public function __construct(
        int $empId,
        string $name,
        string $address,
        string $salaryType,
        float $amount
    ) {
        $this->empId = $empId;
        $this->name = $name;
        $this->address = $address;
        $this->salaryType = $salaryType;
        $this->amount = $amount;
    }


    public function __call($method, $args): mixed
    {
        $prop = lcfirst(substr($method, 3));

        $members = ["empId", "name", "address", "salaryType", "amount"];

        if (in_array($prop, $members)) {
            return $this->$prop;
        }
    }
}
