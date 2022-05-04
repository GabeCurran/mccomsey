<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <div class='flex flex-col max-w-lg m-auto'>
            <h1 class='text-4xl mb-5'>Upcoming Appointments</h1>
            <p>You have no upcoming appointments</p>

            <h1 class='text-4xl my-5'>Request an Appointment</h1>
            <form method='post' action=''>
                @csrf
                <div class='flex flex-col'>
                    <label for='name' class='text-lg'>Name</label>
                    <input type='text' name='name' id='name' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='email' class='text-lg'>Email</label>
                    <input type='email' name='email' id='email' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='phone' class='text-lg'>Phone</label>
                    <input type='tel' name='phone' id='phone' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='date' class='text-lg'>Date</label>
                    <input type='date' name='date' id='date' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='time' class='text-lg'>Time</label>
                    <input type='time' min='8:00' max='16:00' name='time' id='time' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='message' class='text-lg'>Message</label>
                    <textarea name='message' id='message' class='w-full p-2 border border-black rounded-lg' required></textarea>
                </div>
                <button type='submit' class='w-full p-2 mt-5 bg-blue-500 text-white rounded-lg'>Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>