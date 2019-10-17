<?php

namespace App\Providers;

use App\Services\FigureService;
use App\Services\RevisionService;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Figures\Interfaces\FigureServiceInterface;
use Figures\Interfaces\RevisionServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->bind(RevisionServiceInterface::class, RevisionService::class);
        $this->app->bind(FigureServiceInterface::class, FigureService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
