<?php

namespace App\Modules\Employee\Repositories;

use App\Modules\Employee\Models\Employee;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        return Employee::All();
    }

    public function getById($id)
    {
        return Employee::where('id',$id)->get();
    }

    public function create($validated)
    {
        return Employee::create($validated);
    }

    public function updateByID($id)
    {
        return Employee::where('id', $id);
    }

    public function deleteById($id)
    {
        return Employee::where('id',$id)->delete();
    }
}
