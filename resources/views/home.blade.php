@extends('layouts.app') <!--Directiva para llamar vistas con Laravel-->

@section('titulo')

    Página Principal

@endsection

@section('contenido')

    <x-listar-post :posts="$posts"/> <!--pasando informacion al componente listar-post-->
    

@endsection