<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->user_type == '1' || Auth::user()->user_type == '2'){
                return $next($request);
            }else{
                return redirect('/home')->with('error', 'Access Denied! As you are not Admin');
            }
        }else{
            return redirect('/login')->with('message', 'Please Login First!');
        }
    }
}
