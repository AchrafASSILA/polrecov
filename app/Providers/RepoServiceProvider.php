<?php

namespace App\Providers;

use App\Repository\Impayes\ImpayesRepo;
use App\Repository\Impayes\ImpayesRepoInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImpayesRepoInterface::class, ImpayesRepo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
