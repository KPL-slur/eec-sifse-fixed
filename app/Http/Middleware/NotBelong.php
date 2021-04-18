<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class NotBelong
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_approved == 0 || ! $request->user()->hasVerifiedEmail()){
            return $next($request);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
