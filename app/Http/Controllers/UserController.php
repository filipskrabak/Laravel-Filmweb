<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    { 
        $user = Auth::user();

        $this->validate(request(), [
            'name' => 'required|unique:users,name,'.$user->id,
            'email' => 'email|required|unique:users,email,'.$user->id,
            'password' => 'required|min:8|confirmed'
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->back()->with('success', 'Zmeny boli uložené.');
    }
}
