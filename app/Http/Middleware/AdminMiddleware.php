<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        // dd(\Auth::user());
        // dd(\Auth::user()->role);
        $nameRole   = \Auth::user()->role->name;
        $nameStatus = \Auth::user()->status->name;

        if($nameRole === 'Administrador' && $nameStatus === 'Activo')
            return $next($request);

        \Auth::logout();
        return redirect('login');
    }
}
