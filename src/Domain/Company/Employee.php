<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2023 Thorsten Suckow-Homberg https://github.com/ThorstenSuckow/payroll
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace Payroll\Domain\Company;

use BadMethodCallException;

/**
 * @method string getEmpId()
 * @method string getName()
 * @method string getAddress()
 * @method string getSalaryType()
 * @method float getRate()
 * @method string|null getCommissionRate()
 */
class Employee
{
    private string $empId;

    private string $name;
    private string $address;
    private string $salaryType;
    private float $rate;
    private ?float $commissionRate;

    public static function make(
        string $empId,
        string $name,
        string $address,
        string $salaryType,
        float $rate,
        float $commissionRate = null
    ): static {
        /* @phpstan-ignore-next-line */
        return new static(...func_get_args());
    }

    final private function __construct(
        string $empId,
        string $name,
        string $address,
        string $salaryType,
        float $rate,
        float $commissionRate = null
    ) {
        $this->empId = $empId;
        $this->name = $name;
        $this->address = $address;
        $this->salaryType = $salaryType;
        $this->rate = $rate;
        $this->commissionRate = $commissionRate;
    }

    /**
     * @param string $method
     * @param array<int, mixed> $args
     */
    public function __call(string $method, array $args): mixed
    {
        $prop = lcfirst(substr($method, 3));

        $members = [
            "empId",
            "name",
            "address",
            "salaryType",
            "rate",
            "commissionRate"
        ];


        if (in_array($prop, $members)) {
            return $this->$prop;
        }

        throw new BadMethodCallException("$method not found.");
    }
}
