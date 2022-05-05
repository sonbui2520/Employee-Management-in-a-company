<?php

namespace App\Modules\Company\Repositories;

use App\Modules\Company\Models\Company;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll()
    {
        return Company::All();
    }

    public function getById($id)
    {
        return Company::where('id',$id)->get();
    }

    public function create($validated)
    {
        return Company::create($validated);
    }

    public function updateByID($id)
    {
        return Company::where('id',$id);
    }

    public function deleteById($id)
    {
        Company::where('id',$id)->delete();
    }
}
