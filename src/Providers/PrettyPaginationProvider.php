<?php

namespace StSinner\Laravel\PrettyPagination\Providers;

use StSinner\Laravel\PrettyPagination\Routing\Route;
use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Support\ServiceProvider;

class PrettyPaginationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        BaseRoute::mixin(new Route());
    }
}
