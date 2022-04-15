<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <h1 class='text-4xl mb-5'>Upcoming Appointments</h1>
        <p>You have no upcoming appointments</p>

        <h1 class='text-4xl my-5'>Request an Appointment</h1>
        <form method='post' action=''>
            @csrf
            <div class='mb-5'>
                <label for='name' class='block text-gray-700 text-sm font-bold mb-2'>
                    Name
                </label>
                <input type='text' name='name' id='name' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' placeholder='Name'>
            </div>
            <div class='mb-5'>
                <label for='email' class='block text-gray-700 text-sm font-bold mb-2'>
                    Email
                </label>
                <input type='email' name='email' id='email' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' placeholder='Email'>
            </div>
            <div class='mb-5'>
                <label for='phone' class='block text-gray-700 text-sm font-bold mb-2'>
                    Phone
                </label>
                <input type='text' name='phone' id='phone' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' placeholder='Phone'>
            </div>
            <div class='mb-5'>
                <label for='date' class='block text-gray-700 text-sm font-bold mb-2'>
                    Date
                </label>
                <input type='date' name='date' id='date' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' placeholder='Date'>
            </div>
            <div class='mb-5'>
                <label for='time' class='block text-gray-700 text-sm font-bold mb-2'>
                    Time
                </label>
                <input type='time' name='time' id='time' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' placeholder='Time'>
            </div>
        </form>
    </x-slot>
</x-app-layout>