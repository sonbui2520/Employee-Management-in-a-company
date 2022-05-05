<?php

namespace App\Modules\Employee\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Employee\Requests\EmployeeCreateRequest;
use App\Modules\Employee\Requests\EmployeeUpdateRequest;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getAll()
    {
        return $this->employeeService->getAll();
    }

    public function get($id)
    {
        return $this->employeeService->get($id);
    }

    public function create(EmployeeCreateRequest $request)
    {
        return $this->employeeService->create($request);
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        return $this->employeeService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->employeeService->delete($id);
    }
}
