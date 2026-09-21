<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('admin_logged_in', false)) {
            return redirect()->route('admin.login')->with('warning', 'Silakan masuk terlebih dahulu untuk mengakses panel admin.');
        }

        return $next($request);
    }
}
