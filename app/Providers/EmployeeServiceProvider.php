<?php

namespace App\Providers;

use App\Modules\Employee\Repositories\EmployeeRepository;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Modules\Employee\Services\EmployeeService;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            EmployeeServiceInterface::class,
            EmployeeService::class
        );
    }
}
