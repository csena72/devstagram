<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(8);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
