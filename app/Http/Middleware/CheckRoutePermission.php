<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckRoutePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $currentRoute = Route::where('route_name', $request->route()->getName())->first();

        if (!$currentRoute) {
            abort(404, 'Route not found');
        }

        if (!$user->hasRoutePermission($currentRoute, $permission)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
} 