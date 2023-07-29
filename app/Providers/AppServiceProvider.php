<?php

namespace App\Providers;

use App\Repositories\EletrodomesticoRepository;
use App\Repositories\MarcaRepository;
use App\Services\EletrodomesticoService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EletrodomesticoService::class, function (Application $app) {
            return new EletrodomesticoService($app->make(EletrodomesticoRepository::class), $app->make(MarcaRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
