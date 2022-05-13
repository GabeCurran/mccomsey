<x-guesthome-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <h1 class='text-6xl mb-5'>About</h1>
        <div id='home-content'>
            <?php echo $content; ?>
        </div>
        <div class='flex justify-between border-t border-gray pt-6'>
            <div class='basis-1/3 h-80 contact-info mr-3 p-3 border border-black rounded-lg bg-gray-100 flex flex-col justify-center items-center'>
                <h3 class='text-lg'>Contact Info</h3>
                <p class='font-bold'>Address:</p>
                <p>11 E Lancaster Ave</p>
                <p>Oxford, PA 19363</p>
                <p class='font-bold'>Phone:</p>
                <a href='tel:610-467-1330' class='hover:underline'>(610) 467-1330</a>
                <p class='font-bold'>Email:</p>
                <a href='mailto:mccomseyautomotive@gmail.com' class='hover:underline'>mccomseyautomotive@gmail.com</a>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.9157791078887!2d-75.98286888451125!3d39.78644540165321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c7b3511362f155%3A0x56b693145e67edef!2sMcComsey%20Automotive!5e0!3m2!1sen!2sus!4v1648650972285!5m2!1sen!2sus" class='w-2/3 h-auto basis-2/3 rounded-lg border border-black' allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </x-slot>
    <x-slot name='middle_banner'>
        <x-middle-banner></x-middle-banner>
    </x-slot>
    <x-slot name='content2'>
        <h1 class='text-6xl mb-5'> Recent Blog Posts</h1>
        <div class='flex justify-between border-t border-gray pt-6'></div>
        @foreach($posts as $post)
            @if($loop->index >=  3)
                @break
            @endif
            <x-blog-post>
                <x-slot name='post_id'>post{{ $post->id }}</x-slot>
                <x-slot name="title">
                    {{ __($post->title) }}
                </x-slot>
                <x-slot name="author">
                    {{ $post->name }}
                </x-slot>
                <?php $date = new DateTime($post->created_at);
                 $result = $date->format('F j, Y, h:i') ?>
                <x-slot name="datetime">
                    {{ $result }}
                </x-slot>
                <x-slot name="post_content">
                    <?php echo $post->content; ?>
                </x-slot>
                <x-slot name='likeButton'>
                    <button disabled id='like{{ $post->id }}' type='submit' class='px-5 py-1 bg-gray-100 rounded font-bold text-gray-600 hover:bg-gray-200 hover:-translate-y-0.5 hover:drop-shadow-md'>Please sign in to like</button>
                </x-slot>
                <x-slot name="likes">
                    {{ $post->likes }}
                </x-slot>
            </x-blog-post>
            <details class='cursor-pointer'>
                <summary>Show comments ({{ $post->commentsCount }})</summary>
                @foreach($comments as $comment)
                    @if($comment->post_id == $post->id)
                        <x-comment>
                            <x-slot name='comment_id'>
                                comment{{ $comment->id }}
                            </x-slot>
                            <x-slot name="username">
                                {{ $comment->name }}
                            </x-slot>
                            <x-slot name="comment">
                                {{ __($comment->comment) }}
                            </x-slot>
                        </x-comment>
                    @endif
                @endforeach
            </details>
            <x-comment-input name='comment' placeholder='Please sign in to leave a comment!' disabled></x-comment-input>
        @endforeach
        <br>
    </x-slot>
</x-guesthome-layout>
