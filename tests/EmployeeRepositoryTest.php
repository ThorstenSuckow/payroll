<?php

declare(strict_types=1);

namespace Tests\Payroll;

use DateTime;
use Payroll\Employee;
use Payroll\EmployeeRepository;
use Payroll\EmployeeRepositoryException;
use Payroll\SalesReceipt;
use Payroll\TimeCard;
use PHPUnit\Framework\TestCase;

class EmployeeRepositoryTest extends TestCase
{
    /**
     * Use Case 1: Add New Employee
     */
    public function testAddNewEmployee()
    {
        $repository = new EmployeeRepository();
        $this->assertSame(0, $repository->employeeCount());

        $employeeData = [
            $this->getEmployeeTestData(1234, "Peter Parker", "New York", "H", 1245.5),
            $this->getEmployeeTestData(12345, "Peter Parker", "New York", "S", 1245.5),
            $this->getEmployeeTestData(123456, "Peter Parker", "New York", "C", 1245.5, 500),
        ];

        $employeeCount = 0;
        foreach ($employeeData as $data) {
            $employee = $repository->addEmployee(...$data);
            $this->assertInstanceOf(Employee::class, $employee);
            $this->assertSame($repository->employee($data[0]), $employee);
            $employeeCount++;
            $this->assertSame($employeeCount, $repository->employeeCount());
        }
    }


    /**
     * Use Case 2: Deleting an Employee
     */
    public function testDeleteEmployee()
    {
        $existingEmpId = 1234;
        $repository = new EmployeeRepository();

        $this->assertSame(0, $repository->employeeCount());

        $repository->addEmployee(...$this->getEmployeeTestData(empId: $existingEmpId));

        $this->assertTrue($repository->employeeExists($existingEmpId));
        $this->assertTrue($repository->deleteEmployee($existingEmpId));
    }


    public function testDeleteEmployeeException()
    {
        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessageMatches("/Employee not found/");
        $missingEmpId = 55555;
        $repository = new EmployeeRepository();

        $this->assertFalse($repository->employeeExists($missingEmpId));

        $repository->deleteEmployee($missingEmpId);
    }


    public function testAddNewEmployeeException()
    {

        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessage("not a valid Employee");
        $employeeData = [1234, "Peter Parker", "New York", "K", 9090];

        $repository = new EmployeeRepository();

        $repository->addEmployee(...$employeeData);
    }


    /**
     * Use Case 3: Post a Time Card
     */
    public function testPostTimeCard()
    {
        $repository = new EmployeeRepository();

        $repository->addEmployee(...$this->getEmployeeTestData(empId: 1234, salaryType: "H"));

        $date = new DateTime();
        $hours = 20;

        $timeCard = $repository->postTimeCard(1234, $date, $hours);

        $this->assertInstanceOf(TimeCard::class, $timeCard);
        $this->assertTrue($timeCard->equalTo(TimeCard::make($date, $hours)));
    }


    public function testPostTimeCardEmployeeMissing()
    {
        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessageMatches("/Employee not found/");

        $repository = new EmployeeRepository();
        $repository->postTimeCard(1234, new DateTime(), 12);
    }


    public function testPostTimeCardEmployeeNotHourly()
    {

        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessageMatches("/Employee does not work by the hour/");

        $repository = new EmployeeRepository();
        $repository->addEmployee(...$this->getEmployeeTestData(empId: 1234, salaryType: "S"));
        $repository->postTimeCard(1234, new DateTime(), 20);
    }


    /**
     * Use Case 4: Posting a Sales Receipt
     */
    public function testPostSalesReceipt()
    {
        $repository = new EmployeeRepository();

        $empId = 1234;
        $commissionRate = 100;
        $salaryType = "C";

        $employee = $repository->addEmployee(
            ...$this->getEmployeeTestData(
                empId: $empId,
                salaryType: $salaryType,
                commissionRate: $commissionRate
            )
        );

        $date = new DateTime();
        $amount = 500;

        $salesReceipt = $repository->postSalesReceipt($empId, $date, $amount);
        $this->assertTrue($salesReceipt->equalTo(SalesReceipt::make($date, $amount)));
    }

    public function testPostSalesReceiptEmployeeDoesNotExist()
    {
        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessageMatches("/Employee not found/");

        $repository = new EmployeeRepository();

        $repository->postSalesReceipt(1234, new DateTime(), 500);
    }

    public function testPostSalesReceiptEmployeeIsNotCommissioned()
    {
        $this->expectException(EmployeeRepositoryException::class);
        $this->expectExceptionMessageMatches("/Employee is not commissioned/");

        $empId = 1234;
        $salaryType = "S";

        $repository = new EmployeeRepository();
        $repository->addEmployee(
            ...$this->getEmployeeTestData(
                empId: $empId,
                salaryType: $salaryType
            )
        );

        $repository->postSalesReceipt(1234, new DateTime(), 500);
    }


    private function getEmployeeTestData(
        int $empId,
        string $name = "",
        string $address = "",
        string $salaryType = "H",
        float $amount = 1,
        float $commissionRate = 0
    ): array {
        return [$empId, $name, $address, $salaryType, $amount, $commissionRate];
    }
}
