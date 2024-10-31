<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Visitor;
use View;

class VisitorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\LogVisitor::class);

        View::share('visitorCount', Visitor::count());
    }
}