<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Editor') }}
        </h2>
    </x-slot>
    <x-slot name='content1'>
        <form method="POST" action="edit-home">
            @csrf
            <x-blog-editor></x-blog-editor>
        </form>
    <script>
        let title = `{{ $home->title }}`;
        let content = `<?php echo $content; ?>`;
        console.log(content);
    </script>
    </x-slot>

    
</x-app-layout>