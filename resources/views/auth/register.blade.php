@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-5 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imager registro de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="">
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Tu Nombre"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        UserName
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu password de Registro"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repite tu Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite tu password"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>

                <input
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-sky-600 w-full py-3 text-white uppercase font-bold rounded hover:bg-sky-700 transition-colors cursor-pointer"
                />
            </form>
        </div>
    </div>


@endsection
