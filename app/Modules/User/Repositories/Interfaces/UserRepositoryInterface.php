<?php

namespace App\Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create($validated);
}
