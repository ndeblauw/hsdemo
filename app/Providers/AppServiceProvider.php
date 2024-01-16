<?php

namespace App\Providers;

use App\Services\Implementations\IpInfoService;
use App\Services\Interfaces\IpService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(IpService::class, IpInfoService::class);

        Model::preventLazyLoading(! app()->isProduction());
    }
}
