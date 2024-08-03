<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function store(User $user, Post $post, Request $request)
    {


        $validated = request()->validate([
            'comentario' => 'required|max:255',
        ]);

        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $validated['comentario'],
        ]);

        return back()->with('mensaje', 'Comentario creado correctamente');
    }
}
