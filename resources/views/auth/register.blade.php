@extends('layouts.app')
@section('titulo')
Regístrate en Devstagram
@endsection
@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center p-5">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen register">
    </div>

    <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-xl">
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre

                </label>
                <input id="name" name="name" type="text" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name')
                    border-red-500
                @enderror" value="{{old('name')}}">
                @error('name')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre de usuario

                </label>
                <input id="username" name="username" value="{{old('username')}}" type="text"
                    placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror ">

                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
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
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    Tu Password

                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Repite tu password" class="border p-3 w-full rounded-lg">
            </div>

            <input type="submit" value="Crear Cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

        </form>

    </div>

</div>
@endsection