<?php

namespace App\Http\Middleware;

use Closure;

class EmployeeMiddleware
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
        $nameRole = \Auth::user()->role->name;
        $nameStatus = \Auth::user()->status->name;

        if($nameRole === 'Empleado' && $nameStatus === 'Activo') 
            return $next($request);

        \Auth::logout();
        return redirect('login');
    }
}
