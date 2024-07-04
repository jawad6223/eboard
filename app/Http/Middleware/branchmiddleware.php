<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class branchmiddleware
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
        

        if(auth()->check()){
            if(auth()->user()->role_id == 2  && auth()->user()->status == 1){
                return $next($request);
            }
            else{
                return redirect('branch/login');
            }
        }
        else{
            return redirect('branch/login');
        }

    }
}
