<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(auth()->user()) &&  auth()->user()->is_admin == 2 && auth()->user()->status=='Active') {
            return $next($request);
        }
        return redirect('login')->with('‘error’',"You don't have active account please contact support team.");
    }
}
