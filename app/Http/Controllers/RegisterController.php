<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;

use App\Models\Expert;
use App\Models\Reference;
use App\Models\User;

class RegisterController extends Controller
{
    //to display interface for register new user
    public function create()
    {
        $roles = Reference::where('name', 'roles')->whereIn('code', [1, 2])->orderBy('code')->get();

        return view('auth.register', compact('roles'));
    }

    //to save the newly register user to database and login user
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'ref_role_id' => 'required',
            'terms' => 'required'
        ]);

        $user = User::create($attributes);

        if ($user->role->code == 2) {
            Expert::create([
                'user_id' => $user->id,
            ]);
        }
        auth()->login($user);

        if ($user->role->code == 1) {
            return redirect()->route('user.profile');
        } else if ($user->role->code == 2) {
            return redirect()->route('expert.profile');
        } else {
            return redirect()->intended('dashboard');
        }
    }
}
