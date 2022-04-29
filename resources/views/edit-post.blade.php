<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Editor') }}
        </h2>
    </x-slot>
    <x-slot name='content1'>
        <form method="POST" action="update-post">
            @csrf
            <x-blog-updater>
                <x-slot name='post_id'>{{ $post->id }}</x-slot>
                <x-slot name="title">
                    {{ __($post->title) }}
                </x-slot>
            </x-blog-updater>
        </form>
    <script>
        let content = `<?php echo $post->content; ?>`;
        console.log(content);
    </script>
    </x-slot>

    
</x-app-layout>