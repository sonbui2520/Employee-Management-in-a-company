<?php

namespace App\Modules\Company\Services\Interfaces;

interface CompanyServiceInterface
{
    public function getAll();
    public function get($id);
    public function create($request);
    public function update($request, $id);
    public function delete($id);
    public function getEmployeeListOfCompany($company_id);
}
