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
                <x-slot name='likeButton'>
                    @if (in_array($post->id, $likes))
                    <form method='post' action='unlike-post'>
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type='submit' class='px-5 py-1 bg-gray-100 rounded text-red-500 hover:bg-gray-200 hover:-translate-y-0.5 hover:drop-shadow-md'>Unlike</button>
                    </form>
                    @else
                    <form method='post' action='like-post'>
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type='submit' class='px-5 py-1 bg-gray-100 rounded text-blue-500 hover:bg-gray-200 hover:-translate-y-0.5 hover:drop-shadow-md'>Like</button>
                    </form>
                    @endif
                </x-slot>
                <x-slot name="likes">
                    {{ $post->likes }}
                </x-slot>
            </x-blog-post>
            @foreach($comments as $comment)
                @if($comment->post_id == $post->id)
                    <x-comment>
                        <x-slot name="username">
                            {{ $comment->username }}
                        </x-slot>
                        <x-slot name="comment">
                            {{ __($comment->comment) }}
                        </x-slot>
                    </x-comment>
                @endif
            @endforeach
            <form method='post' action='create-comment'>
                @csrf
                <input type='hidden' name='post_id' value='{{ $post->id }}'>
                <x-comment-input name='comment' placeholder='Leave a comment!'></x-comment-input>
                <div class='flex justify-end w-[90%] ml-[3.75rem]'>
                    <button type='submit' class='px-10 py-3 mt-3 bg-blue-400 rounded text-white'>Submit</button>
                </div>
            </form>
        @endforeach
    </x-slot>
</x-app-layout>