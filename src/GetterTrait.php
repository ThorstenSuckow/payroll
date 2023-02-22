<?php

declare(strict_types=1);

namespace Payroll;

use BadMethodCallException;

trait GetterTrait
{
    public function __call($method, $args): mixed
    {
        $prop = lcfirst(substr($method, 3));

        $members = $this->getMembers();

        if (in_array($prop, $members)) {
            return $this->$prop;
        }

        throw new BadMethodCallException("$method not found.");
    }


    abstract private function getMembers(): array;
}
