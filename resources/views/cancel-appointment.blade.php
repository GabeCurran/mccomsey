<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <div class='max-w-lg m-auto'>
            <h1 class='text-4xl mb-5'>Cancel Appointment</h1>
            <p>Are you sure you want to cancel this appointment?</p>
        </div>
        <div class='overflow-x-auto'>
            <table class='table-auto mx-auto'>
                <thead>
                    <tr>
                        <th class='px-4 py-2'>Phone</th>
                        <th class='px-4 py-2'>Date</th>
                        <th class='px-4 py-2'>Service</th>
                        <th class='px-4 py-2'>Description</th>
                        <th class='px-4 py-2'>Confirmed?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='border px-4 py-2'>{{ $appointment->phone }}</td>
                        <td class='border px-4 py-2'>{{ $appointment->appointment_date }}</td>
                        <td class='border px-4 py-2'>{{ $appointment->service_name }}</td>
                        <td class='border px-4 py-2'>{{ $appointment->description }}</td>
                        <td class='border px-4 py-2'>{{ $appointment->confirmed ? 'Yes' : 'No' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='flex mt-5 max-w-lg m-auto'>
            <form method='post' action='/cancel-appointment'>
                @csrf
                <input type='hidden' name='id'  value='{{ $appointment->id }}'>
                <button type='submit' class='w-full p-2 bg-red-500 hover:bg-red-700 text-white rounded-lg'>Cancel Appointment</button>
            </form>
            <form method='post' action='/appointments'>
                @csrf
                <button type='submit' class='w-full ml-5 p-2 bg-blue-500 hover:bg-blue-700 text-white rounded-lg'>Don't Cancel</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>