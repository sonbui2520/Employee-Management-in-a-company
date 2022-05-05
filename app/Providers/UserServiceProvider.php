<?php

namespace App\Providers;

use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Services\Interfaces\UserServiceInterface;
use App\Modules\User\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
    }
}

