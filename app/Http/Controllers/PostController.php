<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except('index', 'show');
    }

    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'imagen' => $validated['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function show(User $user, Post $post)
    {

        return view('posts.show', [
            'post' => $post,
            'user' => $post->user
        ]);
    }
}
