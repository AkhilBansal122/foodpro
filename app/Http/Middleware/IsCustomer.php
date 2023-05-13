<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $directoryURI = $_SERVER['REQUEST_URI'];
            $path = parse_url($directoryURI, PHP_URL_PATH);
            $components = explode('/', $path);

            $uri1= isset($components[2]) ? $components[2] :'';

            $uri2 = isset($components[3]) ? $components[3] :'';
            $checked = false;

            if(substr($uri1, 0, 4)==="TBL-")
            {
            $checked = true;    
            }else{
            $restaurentName = $uri1;
            }
                if($checked==true)
                {
                    if(!empty(auth()->user()) &&  auth()->user()->is_admin == 5 && auth()->user()->status=='Active'){
                        return $next($request);
                    }
                    return redirect()->back()->with('‘error’',"You don't have access pages.");   
                }
                else{
                    return $next($request);
                }
    }
}
