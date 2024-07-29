<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Summary of RegisterController
 *
 * @package App\Http\Controllers
 */
class RegisterController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        dd($request->all());
    }
}
