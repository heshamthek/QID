<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a successful login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Check the user's status (assuming 'status' is a field in your users table)
        if ($user->status != 1) { // Adjust the condition as per your status logic
            Auth::logout(); // Log the user out
            
            // Optionally, you can throw a validation exception or redirect
            throw ValidationException::withMessages([
                'email' => ['Your account is not active.'],
            ]);
        }

        return redirect()->intended($this->redirectTo);
    }
}
