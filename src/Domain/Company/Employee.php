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

use Quant\Traits\Getter;

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
    use Getter;

    final private function __construct(
        #[Getter] private string $empId,
        #[Getter] private string $name,
        #[Getter] private string $address,
        #[Getter] private string $salaryType,
        #[Getter] private float $rate,
        #[Getter] private ?float $commissionRate = null
    ) {
    }


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
}
