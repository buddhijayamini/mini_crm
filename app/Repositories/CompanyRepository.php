<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;

/**
 * Class CompanyRepository.
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompanies()
    {
        return Company::paginate(10);
    }

    public function getCompanyById($compId)
    {
        return Company::findOrFail($compId);
    }

    public function createCompany(array $companyDetails)
    {
        return Company::create($companyDetails);
    }

    public function updateCompany($compId, array $newDetails)
    {
        return Company::whereId($compId)->update($newDetails);
    }

    public function deleteCompany($compId)
    {
       return Company::destroy($compId);
    }

}
