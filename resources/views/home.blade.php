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

        @foreach($posts as $post)
            <div class="mt-4">
                <h3>{{ $post->title }}</h3>
                <?php echo $post->content; ?>
            </div>
        @endforeach
    </x-slot>
</x-app-layout>
