<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Editor') }}
        </h2>
    </x-slot>
    <x-slot name='content1'>
        <form method="POST" action="edit-home">
            @csrf
            <x-home-editor-bruh></x-home-editor-bruh>
        </form>
    <script>
        let content = `<?php echo $content; ?>`;
    </script>
    </x-slot>

    
</x-app-layout>
