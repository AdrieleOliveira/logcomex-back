<?php

namespace App\Providers;

use App\Interfaces\repositories\PokemonRepositoryInterface;
use App\Interfaces\services\PokemonServiceInterface;
use App\Repositories\PokemonRepository;
use App\Services\PokemonService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PokemonServiceInterface::class, PokemonService::class);
        $this->app->singleton(PokemonRepositoryInterface::class, PokemonRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
