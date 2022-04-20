<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <form method="POST" action="create-post">
            @csrf
            <x-blog-editor></x-blog-editor>
        </form>

        @foreach($posts as $post)
            <x-blog-post>
                <x-slot name="title">
                    {{ __($post->title) }}
                </x-slot>
                <x-slot name="post_content">
                    <?php echo $post->content; ?>
                </x-slot>
            </x-blog-post>
            @foreach($comments as $comment)
                @if($comment->post_id == $post->id)
                    <x-comment>
                        <x-slot name="comment">
                            {{ __($comment->comment) }}
                        </x-slot>
                    </x-comment>
                @endif
            @endforeach
            <form method='post' action='create-comment'>
                @csrf
                <input type='hidden' name='post_id' value='{{ $post->id }}'>
                <input type='hidden' name='username' value='guest'>
                <x-comment-input name='comment' placeholder='Leave a comment!'></x-comment-input>
                <div class='flex justify-end'>
                    <button type='submit' class='px-10 py-3 mt-3 bg-blue-400 rounded text-white mr-10'>Submit</button>
                </div>
            </form>
        @endforeach
    </x-slot>
</x-app-layout>