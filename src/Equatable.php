<?php

declare(strict_types=1);

namespace Payroll;

interface Equatable
{
    public function equalTo(object $cmp): bool;
}
