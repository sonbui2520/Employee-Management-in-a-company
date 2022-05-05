<?php

namespace App\Modules\Company\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create($validated);
    public function updateByID($id);
    public function deleteById($id);
}
