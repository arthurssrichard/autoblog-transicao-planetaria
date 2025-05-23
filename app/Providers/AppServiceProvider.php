<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use App\Services\GroqService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GroqService::class, function($app){
            return new GroqService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
