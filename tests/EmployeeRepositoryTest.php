<?php

namespace Tests\Payroll;

use PHPUnit\Framework\TestCase;
use Payroll\EmployeeRepository;


class EmployeeRepositoryTest extends TestCase {


    /**
     * Use Case 1: Add New Employee 
     */
    public function testAddNewEmployee ()
    {
        $repository = new EmployeeRepository(); 

        $employee = $repository->addEmployee(1234, "Peter Parker", "New York", "H", 1245.5);

            


    }



}