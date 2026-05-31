<?php

namespace App\Http\Middleware;

// use Illuminate\Container\Attributes\Auth;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() ||  Auth::user()-> role !== 'owner') {
            abort(403,'You Cannot Enter in this page');
        }
        return $next($request);
    }
}
