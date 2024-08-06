@extends('layouts.app')

@section('titulo')
    Págin Principal
@endsection

@section('contenido')

    @if($posts->count() > 0)

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
        @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.show', ['post' => $post]) }}">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo }}">
            </a>
        </div>
        @endforeach
    </div>

    <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>

    @else
        <p class="text-center">No hay publicaciones aún, debes seguir a otros usuarios para ver sus publicaciones</p>
    @endif


@endsection
