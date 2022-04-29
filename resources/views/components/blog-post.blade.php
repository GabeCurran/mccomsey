<div id='{{ $post_id }}' class="mt-4 p-2">
    <div class='flex border-b mb-2 items-center'>
        <h3 class='text-3xl'>{{ $title }}</h3>
        <div class='flex items-center ml-auto'>
            {{ $edit_button ?? '' }}
            {{ $delete_button ?? '' }}
        </div>
    </div>
    <div class='text-sm mb-5'>by {{ $author }} on {{ $datetime }}</div>
    <div class='blog-content'>{{ $post_content }}</div>
    <div class='flex items-center mt-3'>
        {{ $likeButton }}
        <img src='{{ asset('images/like-button.svg') }}' class='w-5 h-5 ml-3' alt='like'>
        <span class='ml-1 text-gray-600'>{{ $likes }}</span>
    </div>
</div>