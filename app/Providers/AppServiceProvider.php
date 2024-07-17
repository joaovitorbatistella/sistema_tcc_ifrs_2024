<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TCCService;
use App\Services\AppendService;

use App\Services\Contracts\ITCCService;
use App\Services\Contracts\IAppendService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITCCService::class, TCCService::class);
        $this->app->bind(IAppendService::class, AppendService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
