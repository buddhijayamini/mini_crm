<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::paginate(10);
    }

    public function getEmployeeById($empId)
    {
        return Employee::findOrFail($empId);
    }

    public function createEmployee(array $empDetails)
    {
        return Employee::create($empDetails);
    }

    public function updateEmployee($empId, array $newDetails)
    {
        return Employee::whereId($empId)->update($newDetails);
    }

    public function deleteEmployee($empId)
    {
       return Employee::destroy($empId);
    }
}
