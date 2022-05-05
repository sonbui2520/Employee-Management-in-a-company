<?php

namespace App\Modules\Employee\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create($validated);
    public function updateByID($id);
    public function deleteById($id);
}
