<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => Str::slug($validated['username']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        session()->flash('success', 'Cuenta creada exitosamente');

        auth()->attempt($validated);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
