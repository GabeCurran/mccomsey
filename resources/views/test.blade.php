<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>
    <x-slot name='content'>
        <p>{{ $_GET['title'] }}</p>
        <p>{{ $_GET['content'] }}</p>
    </x-slot>
</x-app-layout>