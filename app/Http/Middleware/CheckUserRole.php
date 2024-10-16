<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->session()->has('role')) {
            $loginUserRole = $request->session()->get('role');
            if ($role !== $loginUserRole) {
                return Redirect::back();
            }
        } else {
            return redirect()->route('loginForm');
        }
        return $next($request);
    }
}
