<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create($validated)
    {
        return User::create($validated);
    }
}
