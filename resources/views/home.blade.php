<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <h1 class='text-6xl mb-5'>About</h1>
        <?php echo $content[0]->content; ?>
        <div class='flex justify-between border-t border-gray pt-6'>
            <div class='basis-1/3 h-80 contact-info mr-3 p-3 border border-black rounded-lg bg-gray-100 flex flex-col justify-center items-center'>
                <h3 class='text-lg'>Contact Info</h3>
                <p class='font-bold'>Address:</p>
                <p>11 E Lancaster Ave</p>
                <p>Oxford, PA 19363</p>
                <p class='font-bold'>Phone:</p>
                <p>(610) 467-1330</p>
                <p class='font-bold'>Email:</p>
                <p>mccomsey@auto.com</p>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.9157791078887!2d-75.98286888451125!3d39.78644540165321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c7b3511362f155%3A0x56b693145e67edef!2sMcComsey%20Automotive!5e0!3m2!1sen!2sus!4v1648650972285!5m2!1sen!2sus" class='w-2/3 h-auto basis-2/3 rounded-lg border border-black' allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </x-slot>
    <x-slot name='middle_banner'>
        <x-middle-banner></x-middle-banner>
    </x-slot>
    <x-slot name='content2'>
        <h1 class='text-6xl mb-5'> Recent Blog Posts</h1>
        <p>Occaecat magna elit ipsum nisi deserunt cillum nostrud est deserunt veniam nulla. Enim exercitation et reprehenderit commodo veniam pariatur ad laboris officia nulla officia. Ut eiusmod sit proident. Sit ea do eiusmod deserunt sint laborum cillum fugiat nulla proident id. Quis id amet ullamco sint ut fugiat sit reprehenderit adipisicing. Non irure dolor amet elit aliqua ipsum voluptate. Cupidatat enim deserunt ullamco et exercitation elit do sunt dolore sit sunt pariatur. Consectetur cupidatat consequat aute reprehenderit reprehenderit nisi ullamco consequat et. Eiusmod minim esse laboris pariatur eu proident adipisicing aliqua elit amet. Lorem cupidatat dolor et aliquip.</p>
        <br />
        <p>Exercitation nostrud et commodo. Minim dolore velit ullamco laborum reprehenderit nostrud fugiat nostrud amet eiusmod in pariatur sunt. Et in velit tempor magna anim elit consequat. Id nulla consectetur enim tempor. Incididunt ea nulla pariatur voluptate esse laboris officia elit ut proident occaecat tempor laboris sunt incididunt. Consequat deserunt consequat est est enim veniam amet culpa voluptate. Est exercitation commodo cillum laboris ad irure sunt enim voluptate. Quis adipisicing sint veniam non. Eiusmod qui ullamco consectetur nostrud deserunt magna est. Velit cupidatat est cillum aliqua aliqua exercitation id occaecat eiusmod enim sunt dolor quis veniam.</p>
        <br />
        <p>Voluptate ad aute elit ea pariatur eiusmod consectetur tempor. Lorem id non culpa quis elit. Laborum irure incididunt voluptate proident anim id minim sint sit ex esse eiusmod deserunt. Enim et et voluptate irure quis veniam amet id ex eu ea enim cillum occaecat eu. Ullamco et tempor adipisicing velit do labore adipisicing sit mollit eiusmod consequat et consequat esse. Irure nostrud tempor ipsum. Magna duis reprehenderit commodo reprehenderit. Lorem aute consectetur do irure et culpa ex veniam aliquip nisi. Dolore consectetur enim commodo adipisicing labore. Duis elit eu ut deserunt fugiat duis officia pariatur.</p>
        <br />
        <p>Occaecat magna elit ipsum nisi deserunt cillum nostrud est deserunt veniam nulla. Enim exercitation et reprehenderit commodo veniam pariatur ad laboris officia nulla officia. Ut eiusmod sit proident. Sit ea do eiusmod deserunt sint laborum cillum fugiat nulla proident id. Quis id amet ullamco sint ut fugiat sit reprehenderit adipisicing. Non irure dolor amet elit aliqua ipsum voluptate. Cupidatat enim deserunt ullamco et exercitation elit do sunt dolore sit sunt pariatur. Consectetur cupidatat consequat aute reprehenderit reprehenderit nisi ullamco consequat et. Eiusmod minim esse laboris pariatur eu proident adipisicing aliqua elit amet. Lorem cupidatat dolor et aliquip.</p>
        <br />
        <p>Exercitation nostrud et commodo. Minim dolore velit ullamco laborum reprehenderit nostrud fugiat nostrud amet eiusmod in pariatur sunt. Et in velit tempor magna anim elit consequat. Id nulla consectetur enim tempor. Incididunt ea nulla pariatur voluptate esse laboris officia elit ut proident occaecat tempor laboris sunt incididunt. Consequat deserunt consequat est est enim veniam amet culpa voluptate. Est exercitation commodo cillum laboris ad irure sunt enim voluptate. Quis adipisicing sint veniam non. Eiusmod qui ullamco consectetur nostrud deserunt magna est. Velit cupidatat est cillum aliqua aliqua exercitation id occaecat eiusmod enim sunt dolor quis veniam.</p>
        <br />
    </x-slot>
</x-app-layout>
