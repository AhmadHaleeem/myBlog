<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create() {
        return view('login');
    }
    public function store() {
        if (!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'Message' => 'Your Email or Password is Not Correct'
            ]);
        }
        return redirect('/posts');
    }

    public function destroy() {
        auth()->logout();
        return redirect('/login');
    }
}
