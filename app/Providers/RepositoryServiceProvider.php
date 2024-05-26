<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GraduadoRepository;
use App\Repositories\Interfaces\IGraduadoRepository;
use App\Repositories\CiudadRepository;
use App\Repositories\Interfaces\ICiudadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IGraduadoRepository::class, GraduadoRepository::class);
        $this->app->bind(ICiudadRepository::class, CiudadRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
