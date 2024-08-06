@extends('layouts.app')

@section('titulo')
    Págin Principal
@endsection

@section('contenido')

    <x-listar-post  :posts="$posts" />

@endsection
