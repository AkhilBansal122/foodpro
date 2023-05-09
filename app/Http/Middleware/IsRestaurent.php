<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRestaurent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!is_null(auth()->user()))
        {
            if(!empty(auth()->user()) &&  auth()->user()->is_admin == 2 && auth()->user()->status=='Active'){
                return $next($request);
            }
        }
        return redirect('login')->with('‘error’',"You don't have restaurent access.");

       // return $next($request);
    }
}
