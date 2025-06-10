<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class login
{
        public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login')->with('loginError', 'Por favor, realize o login.');
        }

        return $next($request);
    }
}
