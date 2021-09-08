<?php

namespace StSinner\Laravel\PrettyPagination\Providers;

use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Support\ServiceProvider;
use StSinner\Laravel\PrettyPagination\Routing\Route;

class PrettyPaginationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        BaseRoute::mixin(new Route());
    }
}
