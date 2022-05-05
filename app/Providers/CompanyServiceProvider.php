<?php

namespace App\Providers;

use App\Modules\Company\Repositories\CompanyRepository;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Modules\Company\Services\CompanyService;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );

        $this->app->bind(
            CompanyServiceInterface::class,
            CompanyService::class
        );
    }
}
