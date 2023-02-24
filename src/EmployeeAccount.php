<?php

declare(strict_types=1);

namespace Payroll;

use DateTime;

class EmployeeAccount
{
    private array $charges = [];
    private int $empId;

    public function __construct(int $empId)
    {
        $this->empId = $empId;
    }


    /**
     * Precondition for $chargeTypes should be checked, e.g. Use Case 5, Union Service Charge
     * should only be added if employee is member of union.
     */
    public function addCharge(float $amount, string $chargeType): Charge
    {
        $charge = new Charge(new DateTime(), $amount, $chargeType);
        $this->charges[] = $charge;

        return $charge;
    }


    public function belongsTo(): int
    {
        return $this->empId;
    }
}
