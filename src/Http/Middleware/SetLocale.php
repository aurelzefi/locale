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
        if ($this->hasInvalidLocale($request)) {
            return redirect($this->routeWithLocale($request));
        }

        url()->defaults(['locale' => $request->locale]);

        app()->setLocale($request->locale);

        return $next($request);
    }

    /**
     * Determine if the given request has an invalid locale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasInvalidLocale($request)
    {
        return ! in_array($request->locale, config('locales') ?? []);
    }

    /**
     * Get the route with the locale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function routeWithLocale($request)
    {
        return config('app.locale').'/'.$request->path();
    }
}
