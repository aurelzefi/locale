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
            return redirect(app()->getLocale().$request->getRequestUri());
        }

        app()->setLocale($request->route('locale'));

        url()->defaults(['locale' => app()->getLocale()]);

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
        return ! in_array($request->route('locale'), config('locales') ?? []);
    }
}
