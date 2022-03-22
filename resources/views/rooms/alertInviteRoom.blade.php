<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room List') }}
        </h2>
    </x-slot>

    <div role="alert">

        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
          <p>{{$message}}</p>
        </div>
      </div>

</x-app-layout>