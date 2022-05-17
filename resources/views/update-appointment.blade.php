<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <div class='flex flex-col max-w-lg m-auto'>
            <h1 class='text-4xl my-5'>Update Appointment</h1>
            <form method='post' action='/change-appointment'>
                @csrf
                <input type='hidden' name='id'  value='{{ $appointment->id }}'>
                <div class='flex flex-col'>
                    <label for='phone' class='text-lg'>Phone</label>
                    <input type='tel' name='phone' id='phone' class='w-full p-2 border border-black rounded-lg' pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' value='{{ $appointment->phone }}' required>
                    <small>Format: XXX-XXX-XXXX</small>
                </div>
                <div class='flex flex-col'>
                    <label for='date' class='text-lg'>Date</label>
                    <input type='date' name='date' id='date' class='w-full p-2 border border-black rounded-lg appointmentDateInput'
                    min="<?php echo date("Y-m-d"); ?>" value='{{ $appointment->appointment_date }}' required>
                </div>
                <div class='flex flex-col'>
                    <label for='service' class='text-lg'>Service</label>
                    <select name='service' id='service' class='w-full p-2 border border-black rounded-lg' onchange='toggleDetailsField()' required>
                        <option value=''>Select a service</option>
                        @foreach ($services as $service)
                            @if ($service->id == $appointment->service)
                                <option value='{{ $service->id }}' selected>{{ $service->service_name }}</option>
                            @else
                                <option value='{{ $service->id }}'>{{ $service->service_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div id='details_div' class='flex flex-col hidden'>
                    <label for='details' class='text-lg'>Details</label>
                    <textarea name='details' id='details' class='w-full p-2 border border-black rounded-lg'>{{ $appointment->description }}</textarea>
                </div>
                <small>Note: After changing an appointment, it must be confirmed again.</small>
                <button type='submit' class='w-full p-2 mt-5 bg-blue-500 text-white rounded-lg'>Confirm</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>

<script>
    if (document.getElementById('service').value == '8') {
        document.getElementById('details_div').classList.remove('hidden');
    }
    let year = new Date().toISOString().slice(0, 4);
    let month = new Date().toISOString().slice(5, 7);
    let day = new Date().toISOString().slice(8, 10);
    let dateInput = document.querySelector('.appointmentDateInput');

    function findNextMonth() {
        let nextMonth = Number(month);
        if (nextMonth == 12) {
            nextMonth = 1;
        } else {
            nextMonth++;
        }

        if (month < 10) {
            nextMonth = '0' + nextMonth.toString();
            return nextMonth;
        } else {
            nextMonth = nextMonth.toString();
            return nextMonth;
        }

    }

    dateInput.max = year + "-" + findNextMonth() + "-" + day;

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