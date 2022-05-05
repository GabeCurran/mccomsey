<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <div class='max-w-lg m-auto'>
            <h1 class='text-4xl mb-5'>Upcoming Appointments</h1>
            @if (count($appointments) == 0)
                <p>No appointments scheduled.</p>
        </div>
            @else
        </div>
                <table class='table-auto mx-auto'>
                    <thead>
                        <tr>
                            <th class='px-4 py-2'>Phone</th>
                            <th class='px-4 py-2'>Date</th>
                            <th class='px-4 py-2'>Service</th>
                            <th class='px-4 py-2'>Description</th>
                            <th class='px-4 py-2'>Confirmed?</th>
                            <th class='px-4 py-2'>Completed?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td class='border px-4 py-2'>{{ $appointment->phone }}</td>
                                <td class='border px-4 py-2'>{{ $appointment->appointment_date }}</td>
                                <td class='border px-4 py-2'>{{ $appointment->service_name }}</td>
                                <td class='border px-4 py-2'>{{ $appointment->description }}</td>
                                <td class='border px-4 py-2'>{{ $appointment->confirmed ? 'Yes' : 'No' }}</td>
                                <td class='border px-4 py-2'>{{ $appointment->completed ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        <div class='flex flex-col max-w-lg m-auto'>
            <h1 class='text-4xl my-5'>Request an Appointment</h1>
            <form method='post' action='/create-appointment'>
                @csrf
                <div class='flex flex-col'>
                    <label for='phone' class='text-lg'>Phone</label>
                    <input type='tel' name='phone' id='phone' class='w-full p-2 border border-black rounded-lg' pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' required>
                    <small>Format: XXX-XXX-XXXX</small>
                </div>
                <div class='flex flex-col'>
                    <label for='date' class='text-lg'>Date</label>
                    <input type='date' name='date' id='date' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='service' class='text-lg'>Service</label>
                    <select name='service' id='service' class='w-full p-2 border border-black rounded-lg' onchange='toggleDetailsField()' required>
                        <option value=''>Select a service</option>
                        @foreach ($services as $service)
                            <option value='{{ $service->id }}'>{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id='details_div' class='flex flex-col hidden'>
                    <label for='message' class='text-lg'>Details</label>
                    <textarea name='details' id='details' class='w-full p-2 border border-black rounded-lg'></textarea>
                </div>
                <button type='submit' class='w-full p-2 mt-5 bg-blue-500 text-white rounded-lg'>Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>

<script>
    function toggleDetailsField() {
        if (document.getElementById('service').value == '8') {
            document.getElementById('details_div').classList.remove('hidden');
            document.getElementById('details').required = true;
        } else {
            document.getElementById('details_div').classList.add('hidden');
            document.getElementById('details').required = false;
        }
    }
</script>