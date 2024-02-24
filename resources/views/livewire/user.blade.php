<div wire:click='handleShowUser'
    class="flex justify-around items-center py-5 border-b bg-white rounded shadow hover:scale-110 transition-all cursor-pointer mt-5">
    <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
        alt="Imagen usuario" class="w-10 h-10">

    <div>
        <p class="w-20 overflow-hidden whitespace-nowrap text-ellipsis font-bold">{{ $user->name }}</p>

        <p class="w-20 overflow-hidden whitespace-nowrap text-ellipsis">{{ $user->username }}</p>

    </div>

</div>
