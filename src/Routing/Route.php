<?php

namespace StSinner\Laravel\PrettyPagination\Routing;

use StSinner\Laravel\PrettyPagination\Http\Middleware\SetPrettyPagination;
use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Support\Facades\Route as Router;
use Illuminate\Support\Str;

class Route
{
    public string $uri;

    /**
     * Add the route as pagination.
     *
     * @return callable
     */
    public function paginate(): callable
    {
        return function (?string $prefix = 'page'): void {
            /** @var BaseRoute $this */
            $this->middleware(SetPrettyPagination::class);

            $route = clone $this;

            $route->uri = sprintf(
                '%s%s{page}',
                Str::finish($route->uri, '/'),
                $prefix ? Str::finish($prefix, '/') : ''
            );

            $route->name('.page');

            Router::getRoutes()->add($route);
        };
    }
}
