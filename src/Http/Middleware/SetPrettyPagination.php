<?php

namespace StSinner\Laravel\PrettyPagination\Http\Middleware;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as BaseLengthAwarePaginator;
use Illuminate\Pagination\Paginator as BasePaginator;
use StSinner\Laravel\PrettyPagination\Pagination\LengthAwarePaginator;
use StSinner\Laravel\PrettyPagination\Pagination\Paginator;

class SetPrettyPagination
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $container = Container::getInstance();

        $container->bind(BaseLengthAwarePaginator::class, LengthAwarePaginator::class);
        $container->bind(BasePaginator::class, Paginator::class);

        Paginator::currentPathResolver(function () use ($request) {
            return preg_replace('/\.page$/', '', $request->route()->getName());
        });

        Paginator::currentParametersResolver(function () use ($request) {
            return collect($request->route()->originalParameters())->forget('page')->all();
        });

        Paginator::currentPageResolver(function () use ($request) {
            return max((int)$request->route('page'), 1);
        });

        return $next($request);
    }
}
