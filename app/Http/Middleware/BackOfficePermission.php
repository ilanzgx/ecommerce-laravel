<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BackOfficePermission
{
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('role') != 'administrador' || !$request->session()->get('logged')){
            return redirect()->route('index');
        }
        return $next($request);
    }
}
