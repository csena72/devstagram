@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5">
            @if($user->imagen)
                <img src="{{ asset('perfiles').'/' . $user->imagen }}" alt="Imagen del usuario" class="rounded-full" />
            @else
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen del usuario" />
            @endif
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">

            <div class="flex items-center gap-2">

                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                @auth
                    @if (auth()->user()->id === $user->id)
                    <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>
                    </a>
                    @endif
                @endauth
            </div>

            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                {{ $user->followers->count() }}
                <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followings->count()}}
                <span class="font-normal">Siguiendo</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ count($user->posts) }}
                <span class="font-normal">Posts</span>
            </p>

            @auth
                @if (auth()->user()->id !== $user->id)
                    @if(!$user->siguiendo(auth()->user()))
                        <form action="{{ route('users.follow', $user) }}"
                            method="POST"
                        >
                        @csrf
                            <input
                                type="submit"
                                class="bg-blue-600 py-1 px-3 text-white uppercase font-bold rounded hover:bg-blue-700 transition-colors cursor-pointer"
                                value="Seguir"
                            >
                        </form>
                    @else
                        <form action="{{ route('users.unfollow', $user) }}"
                            method="POST"
                        >
                        @csrf
                        @method('DELETE')
                            <input
                            type="submit"
                            class="bg-red-600 py-1 px-3 text-white uppercase font-bold rounded hover:bg-red-700 transition-colors cursor-pointer"
                            value="Dejar de Seguir"
                            >
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-3xl text-center mt-10 font-black">Publicaciones</h2>

    @if (count($posts) >= 0)

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
        <p class="text-center text-2xl mt-5">No hay publicaciones aún</p>
    @endif

</section>

@endsection
