<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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
    $user = Auth::user();

    if ($user) {
        if ($user->status === 'pending' || $user->status === 'rejected') {
            return redirect('/login'); // Redirect to login
        }

        if ($user->role === 0) {
            return redirect('/'); // Redirect to landing page
        } elseif ($user->role === 1 || $user->role === 2) {
            return $next($request); // Allow access to dashboard
        }
    }

    // If not authenticated, redirect to login
    return redirect('/login');
}

}

