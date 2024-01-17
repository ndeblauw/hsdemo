<?php

namespace App\Providers;

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
        $this->app->bind(IpService::class, config('services.ipservice'));

        Model::preventLazyLoading(! app()->isProduction());
    }
}
