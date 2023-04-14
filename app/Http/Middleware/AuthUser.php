<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if (!$request->session()->exists('id')) {
            return redirect(route('login'))->with('error',"Anda perlu login");
        }

        return $next($request);
    }
}
