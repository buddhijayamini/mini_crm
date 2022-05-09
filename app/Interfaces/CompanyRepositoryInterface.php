<?php

namespace App\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAllCompanies();
    public function getCompanyById($compId);
    public function createCompany(array $compDetails);
    public function updateCompany($compId, array $newDetails);
    public function deleteCompany($compId);
}
