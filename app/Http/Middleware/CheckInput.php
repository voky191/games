<?php

namespace App\Http\Middleware;

use Closure;

class CheckInput
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
        if ($request->input('search') == '') {
            return redirect('/');
        }

        return $next($request);
    }
}
