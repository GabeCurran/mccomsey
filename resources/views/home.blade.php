<x-app-layout>
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
            <x-blog-post>
                <x-slot name="title">
                    {{ __($post->title) }}
                </x-slot>
                <x-slot name="post_content">
                    <?php echo $post->content; ?>
                </x-slot>
            </x-blog-post>
        @endforeach
        <br>
    </x-slot>
</x-app-layout>
