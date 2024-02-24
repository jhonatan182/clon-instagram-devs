@extends('layouts.app')


@section('titulo')
    Busca más amigos para tu red
@endsection


@section('contenido')
    <div class="grid md:grid-cols-2  {{ $users->count() > 2 ? 'lg:grid-cols-3 ' : 'lg:w-1/2 lg:mx-auto' }} gap-x-10 ">
        @foreach ($users as $user)
            <livewire:user :user="$user" />
        @endforeach
    </div>
@endsection
