<?php

namespace App\Modules\Employee\Services\Interfaces;

interface EmployeeServiceInterface
{
    public function getAll();
    public function get($id);
    public function create($request);
    public function update($request, $id);
    public function delete($id);
    public function getEmployeeListOfCompany($company_id);
}
