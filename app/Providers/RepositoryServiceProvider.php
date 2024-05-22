<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GraduadoRepository;
use App\Repositories\Interfaces\IGraduadoRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IGraduadoRepository::class, GraduadoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
