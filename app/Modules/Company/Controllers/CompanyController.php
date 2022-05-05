<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Requests\CompanyCreateRequest;
use App\Modules\Company\Requests\CompanyUpdateRequest;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getAll()
    {
        return $this->companyService->getAll();
    }

    public function get($id)
    {
        return $this->companyService->get($id);
    }

    public function create(CompanyCreateRequest $request)
    {
        return $this->companyService->create($request);
    }

    public function update(CompanyUpdateRequest $request, $id)
    {
        return $this->companyService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->companyService->delete($id);
    }
}
