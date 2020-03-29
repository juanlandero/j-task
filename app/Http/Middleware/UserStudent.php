<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserStudent
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
        if (Auth::check()) {
            if (Auth::user()->pk_usuario_tipo == 3) {
                return $next($request);
            } else {
                return redirect()->route('teacher.index');
            }
        } else { 
            return redirect()->route('login');
        }
        
    }
}
