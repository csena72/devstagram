@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')

<div class="container mx-auto md:flex">

    <div class="md:w-1/2">
        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo }}">

        <div class="py-3 flex items-center gap-3">

            @auth
                <livewire:like-post :post="$post" />
            @endauth

        </div>
        <div>
            <p class="font-bold">{{ $post->user->username }}</p>
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            <p class="mt-5">
                {{ $post->descripcion }}
            </p>
        </div>
        @auth
            @if ($post->user_id === auth()->user()->id)
                <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
                    @method('delete')
                    @csrf

                    <input
                    class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded text-center mt-4"
                    type="submit"
                    value="Eliminar publicación"
                    />

                </form>
            @endif
        @endauth
    </div>

    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            @auth

            <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

            @if(session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center">
                    {{ session('mensaje') }}
                </div>
            @endif

            <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Comentario
                    </label>
                    <textarea
                        name="comentario"
                        id="comentario"
                        class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                    ></textarea>
                    @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input
                type="submit"
                value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-5">
                @if ($post->comentarios->count() > 0)

                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-b border-gray-300">
                            <a href="{{ route('posts.index', $comentario->user) }}">
                                <h3 class="font-bold">{{ $comentario->user->username }}</h3>
                            </a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach

                @else
                    <p class="p-10 text-center">No hay comentarios</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
