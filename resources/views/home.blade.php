<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <x-slot name='content'>
        You are now logged in! Bruh.

        <form method="POST" action="create-post">
            @csrf
            <x-blog-editor></x-blog-editor>
        </form>
    </x-slot>
</x-app-layout>
