<?php

namespace Aurel\Locale\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! in_array($request->locale, config('locales') ?? [])) {
            return redirect($this->routeWithLocale($request));
        }

        url()->defaults(['locale' => $request->locale]);

        app()->setLocale($request->locale);

        return $next($request);
    }

    /**
     * Get the route with the locale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function routeWithLocale($request)
    {
        return implode(['/', config('app.locale'), $request->path()]);
    }
}
