<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isNazer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->Role != config('constants.Role.NAZER') )
        {
            // abort(403,'شما دسترسی لازم را ندارید');
            return  redirect()->route('adminDashboard');
        }
        return $next($request);
    }
}
