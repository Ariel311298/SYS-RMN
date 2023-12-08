<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleMiddleware
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
        if(Auth::user()->rol_id == '1'){
            return $next($request);
        }else if(Auth::user()->rol_id == '2'){
            return $next($request);
        }else if(Auth::user()->rol_id == '3'){
            return $next($request);
        }else if(Auth::user()->rol_id == '4'){
            return $next($request);
        }else if(Auth::user()->rol_id == '5'){
            return $next($request);
        }else{
            return response()->json(['No tiene permiso para acceder a esta pagina por su rol asignado.']);
        }
    }
}
