<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(auth()->user())){
            if(auth()->user()->is_admin == 1){
                return $next($request);
            }
            if(auth()->user()->is_admin == 2){
                return redirect()->route('restaurent.dashboard');
            }
            if(auth()->user()->is_admin == 3){
                return redirect()->route('manager.dashboard');
            }
        }
        return redirect('login')->with('‘error’',"You don't have admin access.");

       // return $next($request);
    }
}
