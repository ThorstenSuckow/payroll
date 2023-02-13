<?php

namespace Payroll;


class EmployeeRepository {


    public function addEmployee(
        string $empId, 
        string $name, 
        string $address, 
        string $salaryType, 
        $salary
    ) : Employee {
        return new Employee($empId, $name, $address, $salaryType, $salary);


    }

}