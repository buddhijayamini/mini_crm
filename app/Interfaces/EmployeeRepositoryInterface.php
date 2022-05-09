<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function getEmployeeById($empId);
    public function createEmployee(array $empDetails);
    public function updateEmployee($empId, array $newDetails);
    public function deleteEmployee($empId);
}
