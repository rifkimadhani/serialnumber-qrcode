<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Barryvdh\DomPDF\ServiceProvider as DomPDFServiceProviderAlias;
use Barryvdh\DomPDF\Facade as DomPDFFacadeAlias;
// use Barryvdh\DomPDF\Facade as PDF;

class DomPDFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(DomPDFServiceProviderAlias::class);
        $this->app->alias('PDF', DomPDFFacadeAlias::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}