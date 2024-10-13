<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user->is_admin == 0) {
            // Admin level 0: no access to any dashboards
            return redirect('/'); // Redirect to home or an unauthorized page
        }

        if ($user->is_admin == 1) {
            // Admin level 1: access only to drug-related links
            $allowedRoutes = [
                'dashboard.drug.create',
                'dashboard.drug.index',
                // Add any other drug-related routes here
            ];

            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect('/'); // Redirect to home or an unauthorized page
            }
        }

        // Admin level 2 (or any other levels) has full access
        return $next($request);
    }
}
