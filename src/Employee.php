<?php

declare(strict_types=1);

namespace Payroll;

class Employee
{
    use GetterTrait;

    private readonly int $empId;
    private string $name;
    private string $address;
    private string $salaryType;
    private float $amount;
    private ?float $commissionRate;



    public static function make(
        int $empId,
        string $name,
        string $address,
        string $salaryType,
        float $amount,
        ?float $commissionRate = null
    ): Employee {

        if (($res = self::validateData(salaryType: $salaryType, commissionRate: $commissionRate)) !== true) {
            throw new EmployeeException($res);
        }


        return new self(...func_get_args());
    }


    private static function validateData(
        string $salaryType,
        ?float $commissionRate
    ): string|bool {

        if (!in_array($salaryType, ["H", "C", "S"])) {
            return "invalid salary type";
        }

        if ($salaryType === "C" && ($commissionRate < 0 || $commissionRate === null)) {
            return "invalid commission rate";
        }

        return true;
    }


    private function __construct(
        int $empId,
        string $name,
        string $address,
        string $salaryType,
        float $amount,
        ?float $commissionRate = null
    ) {

        $this->empId = $empId;
        $this->name = $name;
        $this->address = $address;
        $this->salaryType = $salaryType;
        $this->amount = $amount;
        $this->commissionRate = $commissionRate;
    }


    public function worksByHour(): bool
    {
        return $this->salaryType === "H";
    }


    private function getMembers(): array
    {
        return ["empId", "name", "address", "salaryType", "amount", "commissionRate"];
    }
}
