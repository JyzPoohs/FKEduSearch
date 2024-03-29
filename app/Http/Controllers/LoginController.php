<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    //to validate user and redirect user to respected dashboard
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = User::where('email', $request->email)->first();
            $current = Carbon::now();
            $user->timestamps = false;
            $user->last_login = $current;
            $user->save();
            $user->timestamps = true;

            if (Auth::user()->role->value == 'user') {
                return redirect()->route('user.profile');
            } else if (Auth::user()->role->value == 'expert') {
                return redirect()->route('expert.profile');
            } else {
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //to logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
