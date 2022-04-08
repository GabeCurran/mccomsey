<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <x-slot name='content'>
        You are now logged in! <span class='text-white'>Bruh.</span>
    </x-slot>
</x-app-layout>
