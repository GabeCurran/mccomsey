<div class="mt-4 p-2">
    <h3 class='border-b mb-2 text-3xl'>{{ $title }}</h3>
    <div class='blog-content'>{{ $post_content }}</div>
    <div class='flex items-center mt-3'>
        {{ $likeButton }}
        <img src='{{ asset('images/like-button.svg') }}' class='w-5 h-5 ml-3' alt='like'>
        <span class='ml-1 text-gray-600'>{{ $likes }}</span>
    </div>
</div>