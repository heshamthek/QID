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
         
            return redirect('/');
        }

        if ($user->is_admin == 1) {
       
            $allowedRoutes = [
                'dashboard.drug.create',
                'dashboard.drug.index',
                 'dashboard.drug.edit'
               
            ];

            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect('/login'); 
            }
        }

      
        if ($user->status !== 'active') {
            Auth::logout(); // Log out the user

            // Redirect back with an error message
            return redirect()->back();}

       

        // Admin level 2 (or any other levels) has full access
        return $next($request);
    }
}
