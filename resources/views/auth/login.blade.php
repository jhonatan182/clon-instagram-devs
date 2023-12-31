@extends('layouts.app')
@section('titulo')
Inicia Sesión en Devstagram
@endsection
@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center p-5">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
    </div>

    <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-xl">
        <form action="{{'login'}}" method="POST" novalidate>
            @csrf

            @if (session('mensaje'))

            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
            @endif

            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Tu correo

                </label>
                <input id="email" name="email" value="{{old('email')}}" type="email" placeholder="Tu email de registro"
                    class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror">
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Tu Password

                </label>
                <input id="password" name="password" value="{{old('password')}}" type="password"
                    placeholder="Tu password de registro" class="border p-3 w-full rounded-lg @error('password')
                    border-red-500
                @enderror">
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="checkbox" name="remember">
                <label class="text-gray-500 text-sm">Mantener mi sesion abierta</label>

            </div>

            <input type="submit" value="Iniciar Sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

        </form>

    </div>

</div>
@endsection